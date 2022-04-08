<template>
    <div>
        <form action="#" class="row">
            <div class="col-1 lesson-table-cell text-center">{{ count }}</div>
            <div class="col-7 lesson-table-cell ps-2">{{ student.user.surname }} {{ student.user.name }} {{ student.user.patronymic }}</div>
            <!-- <div class="col-2 lesson-table-cell">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    @change="saveSummaryList" v-model="summaryList.estimation"/>
            </div>
            <div class="col-2 lesson-table-cell">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    @change="saveSummaryList" v-model="summaryList.interim"/>
            </div> -->
        </form>
    </div>
</template>
<script>
  export default {
    props: {
        summaryList: Object,
        student: Object,
        count: Number,
    },
    watch: {
        // 'studentMark.mark1.mark'(newValue)
        // {
        //     if(newValue.length > 1) {
        //         this.studentMark.mark1.mark = newValue[0]
        //     }
        //     const availableChars = ['5', '4', '3', '2', 'н', 'Н']
        //     if (availableChars.indexOf(newValue[0]) == -1) {
        //         this.studentMark.mark1.mark = ''
        //     }
        // },
        // 'studentMark.mark2.mark'(newValue)
        // {
        //     if(newValue.length > 1) {
        //         this.studentMark.mark2.mark = newValue[0]
        //     }
        //     const availableChars = ['5', '4', '3', '2', 'н', 'Н']
        //     if (availableChars.indexOf(newValue[0]) == -1) {
        //         this.studentMark.mark2.mark = ''
        //     }
        // }
    },
    methods: {
        saveSummaryList()
        {
            this.$emit('summaryListSaved', this.summaryList.id, this.summaryList.estimation, this.summaryList.interim)
        },
    }
  }
</script>