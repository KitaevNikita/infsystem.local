<template>
    <div>
        <form action="#" class="row">
            <div class="col-1 lesson-table-cell text-center">{{ count }}</div>
            <div class="col-7 lesson-table-cell ps-2">{{ student.user.surname }} {{ student.user.name }} {{ student.user.patronymic }}</div>
            <div class="lesson-table-cell" :class="mark1Classes">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    v-model="studentMark.mark1.mark" @change="saveLesson"/>
            </div>
            <div class="col-2 lesson-table-cell" v-if="numberOfHours == 2">
                <input type="text" class="lesson-table-input text-center" minlength="1" maxlength="1" 
                    v-model="studentMark.mark2.mark" @change="saveLesson"/>
            </div>
        </form>
    </div>
</template>
<script>
  export default {
    props: {
        numberOfHours: Number,
        student: Object,
        count: Number,
        studentMark: Object,
    },
    watch: {
        'studentMark.mark1.mark'(newValue)
        {
            if(newValue.length > 1) {
                this.studentMark.mark1.mark = newValue[0]
            }
            const availableChars = ['5', '4', '3', '2', 'н', 'Н']
            if (availableChars.indexOf(newValue[0]) == -1) {
                this.studentMark.mark1.mark = ''
            }
        },
        'studentMark.mark2.mark'(newValue)
        {
            if(newValue.length > 1) {
                this.studentMark.mark2.mark = newValue[0]
            }
            const availableChars = ['5', '4', '3', '2', 'н', 'Н']
            if (availableChars.indexOf(newValue[0]) == -1) {
                this.studentMark.mark2.mark = ''
            }
        }
    },
    computed: {
        mark1Classes() {
            return {
                'col-2': this.numberOfHours == 2,
                'col-4': this.numberOfHours == 1,
            }
        },
    },
    methods: {
        saveLesson()
        {
            this.$emit('lessonSaved', this.studentMark.mark1, this.studentMark.mark2)
        },
    }
  }
</script>