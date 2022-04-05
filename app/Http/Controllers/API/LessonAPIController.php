<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Mark;
use App\Models\Discipline;
use App\Http\Requests\MarkRequest;

class LessonAPIController extends Controller
{
    public function getData(Request $request)
    {
        $discipline = Discipline::find($request->discipline_id);
        $lesson = Lesson::with(['students', 'marks'])->find($request->lesson_id);
        return response()->json([
            'discipline' => $discipline,
            'lesson' => $lesson,
        ]);
    }

    public function saveMark(MarkRequest $request)
    {
        $lesson = Lesson::find($request->lesson_id);
        $mark1 = Mark::find($request->mark1_id);
        $mark1->update(['mark' => $request->mark1]);
        if ($lesson->number_of_hours == 2) {
            $mark2 = Mark::find($request->mark2_id);
            $mark2->update(['mark' => $request->mark2]);
        }
    }
}
