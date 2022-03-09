<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Просмотр списка ресурсов
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user = Auth::user();
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $request->user())) {
            // вывод данных
            $users = User::paginate(8);
            return view('admin.users.index', compact('users'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Вызов формы создания ресурса
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        // проверка прав пользователя
        if ($request->user()->can('create', $request->user())) {
            return view('admin.users.create');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Сохранение нового ресурса
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        // проверка прав пользователя
        if ($request->user()->can('create', $request->user())) {
           $request['password'] = bcrypt($request->password);
                $user = User::create($request->all());
                return redirect()->route('admin.users.index');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Просмотр одного ресурса
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();

        $item = User::findOrFail($id);

        // проверка прав пользователя
        if ($request->user()->can('viewAny', $request->user())) {
            // вывод данных
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }

    }

    /**
     * Вызов формы редактирования ресурса
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        $item = User::findOrFail($id);

        if ($request->user()->can('update', $user)) {
            // вывод данных
            return view('admin.users.edit', compact('user'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Обновление данных ресурса
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $user)) {


            $user->surname = $request->surname;
            $user->patronymic = $request->patronymic;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            if ($request->password !== null) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            if ($request->user()->can('viewAny', User::class)) {
                return redirect()->route('admin.users.index');
            } else {
                return redirect()->route('home');
            }
            } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Удаление ресурса
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // проверка прав пользователя
        if ($request->user()->can('delete', $request->user())) {
            // вывод данных
            $user = User::findOrFail($id);
            if($user->role == 'student')
            {
                $user->student->delete();
            }
            $user->delete();

            return redirect()->route('admin.users.index');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}