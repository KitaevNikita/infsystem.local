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
        // проверка прав пользователя
        if ($request->user()->can('viewAny', User::class)) {
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
        // проверка прав пользователя
        if ($request->user()->can('create', User::class)) {
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
        if ($request->user()->can('create', User::class)) {
           $request['password'] = bcrypt($request->password);
                $user = User::create($request->all());
                return redirect()->route('admin.users.index')
                    ->with('status', 'Пользователь успешно добавлен');
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
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $user)) {
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
        $user = User::findOrFail($id);
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
            $user->role = $request->role;
            $user->email = $request->email;
            if ($request->password !== null) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            if ($request->user()->can('viewAny', User::class)) {
                return redirect()->route('admin.users.index')
                    ->with('status', 'Пользователь успешно изменен');
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
        $user = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $user)) {
            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('status', 'Пользователь успешно удален');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}