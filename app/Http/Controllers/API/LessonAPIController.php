<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Discipline;
use App\Http\Requests\MarkRequest;

class LessonAPIController extends Controller
{
    public function getData(Request $request)
    {
        $discipline = Discipline::find($request->discipline_id);
        $lesson = Lesson::find($request->lesson_id);
        $students = $lesson->students;
        $marks = $lesson->marks;
        return response()->json([
            'discipline' => $discipline,
            'lesson' => $lesson,
            'students' => $students,
            'marks' => $marks
        ]);
    }

    public function saveMark(MarkRequest $request)
    {
        return $request->all();
        // $lesson = Lesson::find($request->lesson_id);
        // $student = Student::find($request->student_id);
    }
}
