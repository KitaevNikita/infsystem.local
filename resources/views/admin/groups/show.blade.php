@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Детали группы
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Название группы:</strong> {{ $group->namegroup }}</li>
            <li class="list-group-item"><strong>Дата создания:</strong> {{ $group->created_at }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ route('admin.groups.edit', $group) }}">
                Редактировать
            </a>
            <a class="btn btn-danger" href="{{ route('admin.groups.index') }}">
                Отменить
            </a>
        </div>
    </div>
</div>
@endsection