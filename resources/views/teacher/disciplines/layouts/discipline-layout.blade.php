@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('status'))
        @component('components.success', [
            'message' => session('status'),
        ])
        @endcomponent
    @endif
    <div class="card">
        <h3 class="card-header">
        {{ $discipline->name_of_the_discipline }}&nbsp;({{ $discipline->teacher }})
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Группа:</strong> {{ $discipline->group->namegroup }}</li>
            <li class="list-group-item"><strong>Количество часов:</strong> {{ $discipline->number_hours }}</li>
            <li class="list-group-item"><strong>Промежуточная аттестация:</strong> {{ $discipline->certification }}</li>
        </ul>
        <div class="card-body">
            @can('training')
            <a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('teacher.disciplines.edit', $discipline) }}">
                <i class="bi bi-pencil"></i> Редактировать
            </a>
            @endcan
            <a class="btn btn-success d-inline-block me-1 text-light" href="{{ route('teacher.disciplines.getReport', $discipline) }}">
                <i class="bi bi-file-earmark-bar-graph"></i> Отчет
            </a>
            <a class="btn btn-danger" href="{{ route('teacher.disciplines.index') }}">
                <i class="bi bi-house"></i>  На главную
            </a>
        </div>
    </div>
    @can('teacher')
    <div class="card mt-4">
        <h3 class="card-header">
        Занятия
            <a class="btn btn-sm btn btn-success float-end" 
                href="{{ route('teacher.lessons.create', $discipline) }}"><i class="bi bi-plus-square"></i> Добавить</a>
        </h3>
        <div class="card-body">
            @yield('discipline-content')
        </div>
    </div>
    @endcan  
</div>

@endsection
