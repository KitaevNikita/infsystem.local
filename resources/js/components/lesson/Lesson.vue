<template>
    <div class="container">
        <table class="table table-bordered border-primary mt-4">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Ф.И.О.</th>
                    <th scope="col">1 урок</th>
                    <th scope="col">2 урок</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(student, count) in students" :key="student.id">
                    <td scope="col">{{ count + 1 }}</td>
                    <td scope="col">{{ student.user.surname }} {{ student.user.name }} {{ student.user.patronymic }}</td>
                    <td scope="col" class="no-paddings">
                        <input type="text" class="lesson-table-input" minlength="1" maxlength="1" @input="markValidation"/>
                    </td>
                    <td scope="col" class="no-paddings">
                        <input type="text" class="lesson-table-input" minlength="1" maxlength="1" @input="markValidation"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
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
            this.students.forEach(function(student, index) {
                console.log('Егор точно не Абоба')
                let studentMark = new StudentMark(student.id);
                this.marks.push(studentMark);
            });
        },
        markValidation()
        {
            console.log('Егор Абоба')
        }
    }
}
</script>