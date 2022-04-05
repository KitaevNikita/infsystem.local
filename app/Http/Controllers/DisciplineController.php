<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\User;
use App\Models\Summarylist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DisciplineRequest;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // проверка прав пользователя
        if ($request->user()->can('viewAny', Discipline::class)) {
            $disciplines = Discipline::paginate(5);
            return view('teacher.disciplines.index', compact('disciplines'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // проверка прав пользователя
        if ($request->user()->can('create', Discipline::class)) {
            return view('teacher.disciplines.create');
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
    public function store(DisciplineRequest $request)
    {
        if ($request->user()->can('create', Discipline::class)) {
            $discipline = Discipline::create($request->all());
            $students = $discipline->group->students;
            for ($i=0; $i < count($students); $i++) { 
                Summarylist::create([
                    'discipline_id' => $discipline->id,
                    'student_id' => $students[$i]->id
                ]);
            }
            return redirect()->route('teacher.disciplines.index');
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
    public function show(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $discipline)) {
            return view('teacher.disciplines.show', compact('discipline'));
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
    public function edit(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        if ($request->user()->can('update', $discipline)) {
            return view('teacher.disciplines.edit', compact('discipline'));
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
    public function update(DisciplineRequest $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $discipline)) {
            $discipline->update($request->except('user_id'));
            return redirect()->route('teacher.disciplines.index');
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
    public function destroy(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $discipline)) {
            $discipline->delete();
            return redirect()->route('teacher.disciplines.index');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    public function getReport(Request $request, $id)
    {
        $discipline = Discipline::with(['lessons'])->findOrFail($id);
        // dd($discipline);
        if ($request->user()->can('getReport', $discipline)) {
            return view('teacher.disciplines.report', compact('discipline'));
        } else {
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
