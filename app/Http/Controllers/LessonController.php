<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Discipline;
use App\Models\Group;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    /**
     * Create the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($discipline_id)
    {
        $discipline = Discipline::findOrFail($discipline_id);
        $groups = Group::all(); 
        return view('teacher.disciplines.lessons.create', compact('discipline', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request, $discipline_id)
    {
        $discipline = Discipline::findOrFail($discipline_id);
        $request['discipline_id'] = $discipline->id;

        $group = Group::findOrFail($request->group_id);

        $lesson = Lesson::create($request->all());
        $lesson->students()->attach($group->students);

        return redirect()->route('teacher.lessons.show', [$discipline, $lesson]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($discipline_id, $id)
    {
        $discipline = Discipline::findOrFail($discipline_id);
        $lesson = Lesson::findOrFail($id);
        return view('teacher.disciplines.lessons.show', compact('discipline', 'lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($discipline_id, $id)
    {
        $discipline = Discipline::findOrFail($discipline_id);
        $lesson = Lesson::findOrFail($id);
        $groups = Group::all(); 
        return view('teacher.disciplines.lessons.edit', compact('discipline', 'lesson', 'groups'));
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
        $discipline = Discipline::findOrFail($discipline_id);
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        return redirect()->route('teacher.disciplines.show', $discipline);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $discipline_id, $id)
    {
        $discipline = Discipline::findOrFail($discipline_id);
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('teacher.disciplines.show', $discipline);
    }
}
