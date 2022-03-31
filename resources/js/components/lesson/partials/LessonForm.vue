<template>
    <div>
        <form action="#" @submit.prevent="updateCardioTraining" class="row">
            <div class="col-1 lesson-table-cell text-center">{{ count }}</div>
            <div class="col-7 lesson-table-cell">{{ student.user.surname }} {{ student.user.name }} {{ student.user.patronymic }}</div>
            <div class="col-2 lesson-table-cell">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    v-model="studentMark.mark1" @input="markValidation"/>
            </div>
            <div class="col-2 lesson-table-cell">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    v-model="studentMark.mark2" @input="markValidation"/>
            </div>
        </form>
    </div>
</template>
<script>
  export default {
    props: {
        student: Object,
        count: Number,
        studentMark: Object,
    },
    watch: {
        'studentMark.mark1'(newValue)
        {
            if(newValue.length > 1) {
                this.studentMark.mark1 = newValue[0]
            }
            const availableChars = ['5', '4', '3', '2', 'н', 'Н']
            if (availableChars.indexOf(newValue[0]) == -1) {
                this.studentMark.mark1 = ''
            }
        },
        'studentMark.mark2'(newValue)
        {
            if(newValue.length > 1) {
                this.studentMark.mark2 = newValue[0]
            }
            const availableChars = ['5', '4', '3', '2', 'н', 'Н']
            if (availableChars.indexOf(newValue[0]) == -1) {
                this.studentMark.mark2 = ''
            }
        }
    },
    methods: {
        markValidation(event)
        {
            console.log(event.target.value)
        },
        async updateLesson()
        {
            // await this.$emit('lessonUpdated', this.)
        },
    }
  }
</script>