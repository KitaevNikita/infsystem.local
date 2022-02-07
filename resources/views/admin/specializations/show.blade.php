@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Детали специальности
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-user"><strong>Название специльности:</strong> {{ $specialization->namespec }}</li>
            <li class="list-group-user"><strong>Дата создания:</strong> {{ $specialization->created_at }}</li>
        </ul>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ route('admin.specializations.edit', $specialization) }}">
                Редактировать
            </a>
            <a class="btn btn-danger" href="{{ route('admin.specializations.index') }}">
                Отменить
            </a>
        </div>
    </div>
</div>
@endsection
