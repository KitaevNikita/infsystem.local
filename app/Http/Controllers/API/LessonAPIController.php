<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Discipline;

class LessonAPIController extends Controller
{
    public function getData(Request $request)
    {
        $discipline = Discipline::find($request->discipline_id);
        $lesson = Lesson::find($request->lesson_id);
        $students = $lesson->students;
        return response()->json([
            'discipline' => $discipline,
            'lesson' => $lesson,
            'students' => $students,
        ]);
    }
}