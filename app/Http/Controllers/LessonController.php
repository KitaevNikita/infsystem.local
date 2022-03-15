<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\User;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    /**
     * Create the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($discipline_id, Request $request)
    {
        $user = Auth::user();
        // проверка прав пользователя
        if ($request->user()->can('create', User::class)) {
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
        if ($request->user()->can('create', User::class)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $request['discipline_id'] = $discipline->id;
            $group = Group::findOrFail($request->group_id);
            $lesson = Lesson::create($request->all());
            $lesson->students()->attach($group->students);
            return redirect()->route('teacher.lessons.show', [$discipline, $lesson]);
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
    public function show($discipline_id, Request $request, $id)
    {
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $user)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $lesson = Lesson::findOrFail($id);
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
    public function edit($discipline_id, Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->user()->can('update', $user)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $lesson = Lesson::findOrFail($id);
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
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $user)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $lesson = Lesson::findOrFail($id);
            $lesson->update($request->all());
            return redirect()->route('teacher.disciplines.show', $discipline);
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
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $user)) {
            $discipline = Discipline::findOrFail($discipline_id);
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();
            return redirect()->route('teacher.disciplines.show', $discipline);
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
