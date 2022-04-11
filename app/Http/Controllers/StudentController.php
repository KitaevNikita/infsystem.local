<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;

class StudentController extends Controller
{
    public const paginate = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // проверка прав пользователя
        if ($request->user()->can('viewAny', Student::class)) {
            $students = Student::paginate(self::paginate);
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
        // проверка прав пользователя
        if ($request->user()->can('create', Student::class)) {
            $groups = Group::all();
            $users = User::where('role', 'student')->doesntHave('student')->get();
            return view('admin.students.create', compact('users', 'groups'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withMessage(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        if ($request->user()->can('create', Student::class)) {
            $request['role'] = 'student';
            $user = User::create($request->only(['name', 'surname', 'patronymic', 'email', 'role', 'password']));
            $request['user_id'] = $user->id;
            Student::create($request->only(['user_id', 'number', 'group_id']));
            return redirect()->route('admin.students.index')
                ->with('status', 'Студент успешно добавлен');
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
        $student = Student::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $student)) {
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
        $student = Student::findOrFail($id);
        if ($request->user()->can('update', $student)) {
            $user = $student->user;
            $groups = Group::all();
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $user->student)) {
            $user->surname = $request->surname;
            $user->patronymic = $request->patronymic;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password !== null) {
                $user->password = bcrypt($request->password);
            }
            if ($request->role === null) {
                $request->role = $user->role; 
            }
            $user->role = $request->role;
            $user->save();
            if ($request->number !== null) {
<<<<<<< HEAD
                $user->student->number = $request->number;
            }
            $user->student->group_id = $request->group_id;
            $user->student->save();

=======
                $request->number = $student->number;
            }
            $student->update($request->except('user_id'));
>>>>>>> ba82d1211741afb6d409f8451cec39f159da7103
            return redirect()->route('admin.students.index')
                ->with('status', 'Студент успешно изменен');
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
        $student = Student::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $student)) {
            $student->user->delete();
            $student->delete();

            return redirect()->route('admin.students.index')
                ->with('status', 'Студент успешно удален');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
