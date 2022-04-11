<template>
    <div>
        <form action="#" class="row">
            <div class="col-1 lesson-table-cell text-center">{{ count }}</div>
            <div class="col-7 lesson-table-cell ps-2">{{ student.user.surname }} {{ student.user.name }} {{ student.user.patronymic }}</div>
            <div class="col-2 lesson-table-cell">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    @change="saveSummaryList" v-model="student.estimation"/>
            </div>
            <div class="col-2 lesson-table-cell">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    @change="saveSummaryList" v-model="student.interim"/>
            </div>
        </form>
    </div>
</template>
<script>
  export default {
    props: {
        student: Object,
        count: Number,
    },
    watch: {
        'student.estimation'(newValue)
        {
            if(newValue.length > 1) {
                this.student.estimation = newValue[0]
            }
            const availableChars = ['5', '4', '3', '2']
            if (availableChars.indexOf(newValue[0]) == -1) {
                this.student.estimation = ''
            }
        },
        'student.interim'(newValue)
        {
            if(newValue.length > 1) {
                this.student.interim = newValue[0]
            }
            const availableChars = ['5', '4', '3', '2']
            if (availableChars.indexOf(newValue[0]) == -1) {
                this.student.interim = ''
            }
        }
    },
    methods: {
        saveSummaryList()
        {
            this.$emit('summaryListSaved', this.student.summaryList_id, this.student.estimation, this.student.interim)
        },
    }
  }
</script>