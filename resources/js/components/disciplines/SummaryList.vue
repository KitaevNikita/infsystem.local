<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-1 lesson-table-header-cell text-center">№</div>
            <div class="col-7 lesson-table-header-cell">Ф.И.О.</div>
            <div class="col-2 lesson-table-header-cell text-center">Семестровая оценка</div>
            <div class="col-2 lesson-table-header-cell text-center">Пром. аттестация</div>
        </div>
        <SummaryListForm v-for="(student, count) in students" :key="student.id" 
            :student="student" :count="count + 1" 
            :summaryList="summaryLists[count]"
            @summary-list-saved="saveSummaryList">
        </SummaryListForm>
    </div>
</template>
<script>

import SummaryListForm from './partials/SummaryListForm.vue';

export default {
    components: {
        SummaryListForm,
    },
    props: {
        discipline_id: Number
    },
    data() {
        return {
            discipline: {},
            students: [],
            summaryLists: [],
        }
    },
    beforeMount() {
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
                    this.summaryLists = this.data.summary_lists
                }).catch(error => {
                    console.log(error)
                });
        },
    }
}
</script>