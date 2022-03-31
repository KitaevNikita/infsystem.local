<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-1 lesson-table-header-cell text-center">#</div>
            <div class="col-7 lesson-table-header-cell">Ф.И.О.</div>
            <div class="col-2 lesson-table-header-cell text-center">Урок 1</div>
            <div class="col-2 lesson-table-header-cell text-center">Урок 2</div>
        </div>
        <LessonForm v-for="(student, count) in students" :key="student.id" 
            :student="student" :count="count + 1" :student-mark="marks[count]"
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
            students: [],
            marks: [],
        }
    },
    created() {
        this.getData()
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
                    this.students = response.data.students
                    this.fillMarksArray()
                }).catch(error => {
                    console.log(error)
                });
        },
        fillMarksArray()
        {
            for(let i = 0; i < this.students.length; i++)
            {
                let studentMark = new StudentMark(this.students[i].id);
                this.marks.push(studentMark); 
            }
        },
        saveLesson(studentId, mark1, mark2)
        {
            const data = {
                student_id: studentId,
                lesson_id: this.lesson.id,
                mark1: mark1,
                mark2: mark2,
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