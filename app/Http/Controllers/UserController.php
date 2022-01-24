<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if ($request->user()->can('viewAny', $request->user())) {
            // вывод данных
            $items = User::paginate(10);
            return view('admin.users.index', compact('items'));
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
    public function store(Request $request)
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
                // проверка прав пользователя
        if ($request->user()->can('viewAny', $request->user())) {
            // вывод данных
            $item = User::findOrFail($id);
            return view('admin.users.show', compact('item'));
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
        $item = User::findOrFail($id);// проверка прав пользователя
        if ($request->user()->can('update', $item)) {
            // вывод данных
            return view('admin.users.edit', compact('item'));
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
    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $item)) {


            $item->name = $request->name;
            $item->email = $request->email;
            $item->role = $request->role;
            if ($request->password !== null) {
                $item->password = bcrypt($request->password);
            }
            $item->save();
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
            $item = User::findOrFail($id);
            $item->student->delete();
            $item->delete();

            return redirect()->route('admin.users.index');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}