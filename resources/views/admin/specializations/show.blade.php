@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-3">
        <h3 class="card-header">
            {{ $specialization->namespec }}
        </h3>
        <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Дата создания:</strong> {{ $specialization->created_at }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('admin.specializations.edit', $specialization) }}">
                <i class="bi bi-pencil"></i> Редактировать
            </a>
            <a class="btn btn-danger" href="{{ route('admin.specializations.index') }}">
                <i class="bi bi-house"></i>  На главную
            </a>
        </div>
    </div>
    @include('admin.groups.partials.group-list', ['groups' => $specialization->groups])
</div>
@endsection
