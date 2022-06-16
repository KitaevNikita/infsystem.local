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
            @can('training')
            <a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('admin.groups.edit', $group) }}">
                <i class="bi bi-pencil"></i> Редактировать
            </a>
            @endcan
            <a class="btn btn-danger d-inline-block me-1 text-light" href="{{ route('admin.groups.index') }}">
                <i class="bi bi-house"></i> На главную
            </a>
            @can('classteacher')
            <a class="btn btn-success" href="{{ route('admin.groups.statement', $group) }}">
                <i class="bi bi-file-earmark-text"></i> Сводная ведомость
            </a>
            @endcan
        </div>
    </div>
    @include('admin.students.partials.student-list')
</div>
@endsection