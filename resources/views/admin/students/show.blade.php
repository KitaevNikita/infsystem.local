@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
        {{ $student->user->full_name }}
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Номер студенческого билета:</strong> {{ $student->number }}</li>
            <li class="list-group-item"><strong>Группа:</strong> {{ $student->group->namegroup }}</li>
            <li class="list-group-item"><strong>Дата создания и редактирования:</strong> {{ $student->created_at }} / {{ $student->updated_at }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('admin.students.edit', $student->id) }}">
                <i class="bi bi-pencil"></i> Редактировать
            </a>
            <a class="btn btn-danger" href="{{ route('admin.students.index') }}">
                <i class="bi bi-house"></i> На главную
            </a>
        </div>
    </div>
</div>

@endsection
