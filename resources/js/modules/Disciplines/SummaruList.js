export default class StudentMark
{
    discipline_id;
    student_id;
    estimation;
    interim;

    constructor(student_id, mark1, mark2) {
        this.student_id = student_id;
        this.mark1 = mark1;
        this.mark2 = mark2;
    }
}