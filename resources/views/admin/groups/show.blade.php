@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-3">
        <h3 class="card-header">
            {{ $group->namegroup }}
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Дата создания:</strong> {{ $group->created_at }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('admin.groups.edit', $group) }}">
                <i class="bi bi-pencil"> Редактировать</i>
            </a>
            <a class="btn btn-danger" href="{{ route('admin.groups.index') }}">
            <i class="bi bi-house"> На главную</i>
            </a>
        </div>
    </div>
    @include('admin.students.partials.student-list')
</div>
@endsection