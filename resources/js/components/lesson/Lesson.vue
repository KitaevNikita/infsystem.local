<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-1 lesson-table-header-cell text-center">#</div>
            <div class="col-7 lesson-table-header-cell">Ф.И.О.</div>
            <div class="lesson-table-header-cell text-center" :class="mark1Classes">Урок 1</div>
            <div class="col-2 lesson-table-header-cell text-center" v-if="lesson.number_of_hours == 2">Урок 2</div>
        </div>
        <LessonForm v-for="(student, count) in lesson.students" :key="student.id" 
            :number-of-hours="lesson.number_of_hours"
            :student="student" :count="count + 1" 
            :student-mark="marks[count]"
            @lesson-saved="saveLesson">
        </LessonForm>
    </div>
</template>
<script>

import LessonForm from './partials/LessonForm.vue';
import StudentMark from '../../modules/lessons/StudentMark';

export default {
    components: {
        LessonForm,
    },
    props: {
        discipline_id: Number,
        lesson_id: Number,
    },
    data() {
        return {
            discipline: {},
            lesson: {},
            marks: [],
        }
    },
    created() {
        this.getData()
    },
    computed: {
        mark1Classes() {
            return {
                'col-2': this.lesson.number_of_hours == 2,
                'col-4': this.lesson.number_of_hours == 1,
            }
        },
    },
    methods: {
        getData()
        {
            let config = {
                params: {
                    discipline_id: this.discipline_id,
                    lesson_id: this.lesson_id, 
                }
            }
            axios.get('/api/get-data', config)
                .then(response => {
                    console.log(response)
                    this.discipline = response.data.discipline
                    this.lesson = response.data.lesson
                    this.fillMarksArray()
                }).catch(error => {
                    console.log(error)
                });
        },
        fillMarksArray()
        {
            for(let i = 0; i < this.lesson.students.length; i++)
            {
                const student = this.lesson.students[i]
                const studentMarks = this.lesson.marks.filter(function(item, index, array) {
                    return item.student_id == student.id;
                });
                let studentMark 
                if (studentMarks.length == 1) {
                    studentMark = new StudentMark(student.id, studentMarks[0], null);    
                }
                else if (studentMarks.length == 2) {
                    studentMark = new StudentMark(student.id, studentMarks[0], studentMarks[1]);  
                }
                this.marks.push(studentMark); 
            }
        },
        saveLesson(mark1, mark2)
        {
            const data = {
                lesson_id: this.lesson.id,
                mark1_id: mark1.id,
                mark2_id: mark2.id,
                mark1: mark1.mark,
                mark2: mark2.mark
            }
            axios.post('/api/save-mark', data)
                .then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error.response)
                });
        }   
    }
}
</script>