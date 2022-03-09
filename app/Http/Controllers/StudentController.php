<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserStudent\UserStudentStoreRequest;
use App\Http\Requests\UserStudent\UserStudentUpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        // проверка прав пользователя
        if ($request->user()->can('viewAny', User::class)) {
            $students = Student::paginate(8);
            return view('admin.students.index', compact('students'));
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
        $user = Auth::user();
        // проверка прав пользователя
        if ($request->user()->can('create', User::class)) {
            $groups = Group::all();
            $users = User::where('role', 'student')->doesntHave('student')->get();
            return view('admin.students.create', compact('users', 'groups'));
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
    public function store(UserStudentStoreRequest $request)
    {
        if ($request->user()->can('create', User::class)) {
            $user = User::create($request->only(['name', 'surname', 'patronymic', 'email', 'role', 'password']));
            $request['user_id'] = $user->id;
            Student::create($request->only(['user_id', 'number', 'group_id']));
            return redirect()->route('admin.students.index');
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
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $user)) {
            $student = Student::findOrFail($id);
            return view('admin.students.show', compact('student'));
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
        $user = User::findOrFail($id);
        if ($request->user()->can('update', $user)) {
            $groups = Group::all();
            $user = User::findOrFail($id);
            return view('admin.students.edit', compact('user', 'groups'));
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
    public function update(UserStudentUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $user)) {
            $student = Student::findOrFail($id);
            $student->update($request->except('user_id'));
            return redirect()->route('admin.students.index');
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
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $user)) {
            //вывод данных
            $student = Student::findOrFail($id);
            $student->user->delete();
            $student->delete();

            return redirect()->route('admin.students.index');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
