@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
         {{ $discipline->name_of_the_discipline }}
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-user"><strong>Ф.И.О. преподавателя:</strong> {{ $discipline->teacher }}</li>
            <li class="list-group-user"><strong>Количество часов:</strong> {{ $discipline->number_hours }}</li>
            <li class="list-group-user"><strong>Промежуточная аттестация:</strong> {{ $discipline->certification }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ route('teacher.disciplines.edit', $discipline) }}">
            Редактировать
            </a>
            <a class="btn btn-danger" href="{{ route('teacher.disciplines.index') }}">
            Отмена
            </a>
        </div>
    </div>
    
    @can('teacher')

    <div class="card mt-4">
        <h3 class="card-header">
        Занятия
            <a class="btn btn-sm btn btn-success float-end" 
                href="{{ route('teacher.lessons.create', $discipline) }}">Добавить занятие</a>
        </h3>
        <div class="card-body">
            @yield('discipline-content')
        </div>
    </div>

    @endcan
</div>

@endsection
