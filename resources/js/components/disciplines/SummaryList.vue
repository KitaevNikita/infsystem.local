<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-1 lesson-table-header-cell text-center">№</div>
            <div class="col-7 lesson-table-header-cell">Ф.И.О.</div>
            <div class="col-2 lesson-table-header-cell text-center">Семестровая оценка</div>
            <div class="col-2 lesson-table-header-cell text-center">Пром. аттестация</div>
        </div>
        <div v-for="(student, count) in students" :key="student.id">
            <form action="#" class="row">
                <div class="col-1 lesson-table-cell text-center">{{ count + 1 }}</div>
                <div class="col-7 lesson-table-cell ps-2">{{ student.user.surname }} {{ student.user.name }} {{ student.user.patronymic }}</div>
                <div class="col-2 lesson-table-cell">
                    <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                        @change="saveSummaryList"/>
                </div>
                <div class="col-2 lesson-table-cell">
                    <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                        @change="saveSummaryList"/>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        discipline_id: Number
    },
    data() {
        return {
            discipline: {},
            students: [],
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
                }
            }
            axios.get('/api/summary-list/get-data', config)
                .then(response => {
                    console.log(response)
                    this.discipline = response.data.discipline
                    this.students = this.discipline.group.students
                }).catch(error => {
                    console.log(error)
                });
        },
    }
}
</script>