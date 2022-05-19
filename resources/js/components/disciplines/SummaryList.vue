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
                    this.findSummaryListForStudent(response.data.discipline.group.students, response.data.summaryLists)
                }).catch(error => {
                    console.log(error)
                });
        },
        findSummaryListForStudent(students, summaryLists)
        {
            for(let i = 0; i < students.length; i++)
            {
                const student = students[i]
                const summaryList = summaryLists.find(function (item, index, array) {
                    return item.student_id == student.id
                })
                student.summaryList_id = summaryList.id
                student.interim = summaryList.interim
                student.estimation = summaryList.estimation
                this.students.push(student)
            }
        },
        saveSummaryList(summaryListId, estimation, interim) 
        {
            let data = {
                summary_list_id: summaryListId,
                estimation: estimation,
                interim: interim,
            }
            axios.post('/api/summary-list/save', data)
                .then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error.response)
                });
        },
    }
}
</script>