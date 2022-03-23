import Mark from "./Mark";

export default class StudentMarks 
{
    student_id;
    mark1;
    mark2;

    constructor(student_id) {
        this.student_id = student_id;
        this.mark1 = new Mark();
        this.mark2 = new Mark();
    }
}