<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // проверка прав пользователя
        if ($request->user()->can('viewAny', Group::class)) {
            $groups = Group::all();
            return view('admin.groups.index', compact('groups'));
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
        if ($request->user()->can('create', Group::class)) {
            $specializations = Specialization::all();
            return view('admin.groups.create', compact('specializations'));
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
    public function store(GroupRequest $request)
    {
        if ($request->user()->can('create', Group::class)) {
            Group::create($request->all());
            return redirect()->route('admin.groups.index')
                ->with('status', 'Группа успешно добавлена');
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
        $group = Group::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $group)) {
            $students = Student::where('group_id', $group->id)->paginate(StudentController::paginate);
            return view('admin.groups.show', compact('group', 'students'));
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
        $group = Group::findOrFail($id);
        if ($request->user()->can('update', $group)) {
            $specializations = Specialization::all();
            return view('admin.groups.edit', compact('specializations', 'group'));
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
    public function update(GroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $group)) {
            $group->update($request->except('user_id'));
            return redirect()->route('admin.groups.index')
                ->with('status', 'Группа успешно изменена');
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
        $group = Group::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $group)) {
            $group->delete();
            return redirect()->route('admin.groups.index')
                ->with('status', 'Группа успешно удалена');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
