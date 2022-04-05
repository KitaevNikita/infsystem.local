<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // проверка прав пользователя
        if ($request->user()->can('viewAny', Specialization::class)) {
            $specializations = Specialization::all();
            return view('admin.specializations.index', compact('specializations'));
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
        if ($request->user()->can('create', Specialization::class)) {
            return view('admin.specializations.create');
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
    public function store(SpecializationRequest $request)
    {
        if ($request->user()->can('create', Specialization::class)) {
            Specialization::create($request->all());
            return redirect()->route('admin.specializations.index')->with('status', 'Студент успешно добавлен');
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
        $specialization = Specialization::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('viewAny', $specialization)) {
            return view('admin.specializations.show', compact('specialization'));
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
        $specialization = Specialization::findOrFail($id);
        if ($request->user()->can('update', $specialization)) {
            return view('admin.specializations.edit', compact('specialization'));
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
    public function update(SpecializationRequest $request, $id)
    {
        $specialization = Specialization::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('update', $specialization)) {
            $specialization->update($request->except('user_id'));
            return redirect()->route('admin.specializations.index')->with('status', 'Студент успешно изменен');
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
        $specialization = Specialization::findOrFail($id);
        // проверка прав пользователя
        if ($request->user()->can('delete', $specialization)) {
            $specialization->delete();
            return redirect()->route('admin.specializations.index')->with('status', 'Студент успешно удален');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
