<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\User;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    /**
     * Create the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $discipline_id)
    {
        // проверка прав пользователя
        if ($request->user()->can('create', Lesson::class)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $groups = Group::all(); 
            return view('teacher.disciplines.lessons.create', compact('discipline', 'groups'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request, $discipline_id)
    {
        if ($request->user()->can('create', Lesson::class)) {
            $discipline = Discipline::findOrFail($discipline_id);            
            $request['discipline_id'] = $discipline->id;
            $lesson = Lesson::create($request->all());
            $lesson->students()->attach($discipline->group->students);
            for ($i=0; $i < count($lesson->students); $i++) {
                for ($i2=0; $i2 < $lesson->number_of_hours; $i2++) { 
                    $info = [
                        'student_id' => $lesson->students[$i]->id,
                        'lesson_id' => $lesson->id
                    ];
                    Mark::create($info);
                }
            }
            return redirect()->route('teacher.lessons.show', [$discipline, $lesson])
                ->with('status', 'Урок успешно добавлен');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $discipline_id, $id)
    {
        $lesson = Lesson::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('view', $lesson)) {
            $discipline = Discipline::findOrFail($discipline_id);
            return view('teacher.disciplines.lessons.show', compact('discipline', 'lesson'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $discipline_id, $id)
    {
        $lesson = Lesson::findOrFail($id);
        if ($request->user()->can('update', $lesson)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $groups = Group::all(); 
            return view('teacher.disciplines.lessons.edit', compact('discipline', 'lesson', 'groups'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $discipline_id, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $previous_number_of_hours = $lesson->number_of_hours;
        // проверка прав пользователя
        if ($request->user()->can('update', $lesson)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $lesson->update($request->all());
            if ($lesson->number_of_hours != $previous_number_of_hours) {
                if ($lesson->number_of_hours > $previous_number_of_hours) {
                    for ($i=0; $i < count($lesson->students); $i++) {
                        $info = [
                            'student_id' => $lesson->students[$i]->id,
                            'lesson_id' => $lesson->id
                        ];
                        Mark::create($info);
                    }        
                } elseif ($lesson->number_of_hours < $previous_number_of_hours) {
                    for ($i=0; $i < count($lesson->students); $i++) {
                        $marks = Mark::where('student_id', '=', $lesson->students[$i]->id)
                            ->where('lesson_id', '=', $lesson->id)->get();
                        if (count($marks) == 2) {
                            $marks[1]->delete();
                        }
                    }
                }
            }
            return redirect()->route('teacher.lessons.show', [$discipline, $lesson])
                    ->with('status', 'Урок успешно изменен');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $discipline_id, $id)
    {
        $lesson = Lesson::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $lesson)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $lesson->delete();
            return redirect()->route('teacher.disciplines.show', $discipline)
            ->with('status', 'Урок успешно удален');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
