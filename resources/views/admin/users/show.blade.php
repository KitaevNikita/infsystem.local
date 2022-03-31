@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            {{ $user->full_name }}
        </h3>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>E-mail:</strong> {{ $user->email }}
                </li>
                <li class="list-group-item">
                    <strong>Роль:</strong> {{ $user->role_name }}
                </li>
                <li class="list-group-item">
                    <strong>Дата добавления:</strong> {{ $user->created_at }}
                </li>
                <li class="list-group-item">
                    <strong>Дата последнего обновления:</strong> {{ $user->updated_at }}
                </li>
            </ul>
            <hr>
            <a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('admin.users.edit', $user) }}">
                <i class="bi bi-pencil"> Редактировать</i>
            </a>
            <a class="btn btn-danger" href="{{ route('admin.users.index') }}">
            <i class="bi bi-house"> На главную</i>
            </a>
        </div>
    </div>
</div>

@endsection
