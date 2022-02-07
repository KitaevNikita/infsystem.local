@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Детали студента
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-user"><strong>Фамилия:</strong> {{ $student->user->name }}</li>
            <li class="list-group-user"><strong>Имя:</strong> {{ $student->user->surname }}</li>
            <li class="list-group-user"><strong>Отчество:</strong> {{ $student->user->patronymic }}</li>
            <li class="list-group-user"><strong>Номер студенческого билета:</strong> {{ $student->number }}</li>
            <li class="list-group-user"><strong>Группа:</strong> {{ $student->group->namegroup }}</li>
            <li class="list-group-user"><strong>Дата создания:</strong> {{ $student->created_at }}</li>
            <li class="list-group-user"><strong>Дата редактирования:</strong> {{ $student->updated_at }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ route('admin.students.edit', $student->id) }}">
                Редактировать
            </a>
            <a class="btn btn-danger" href="{{ route('admin.students.index') }}">
                Отмена
            </a>
        </div>
    </div>
</div>

@endsection
