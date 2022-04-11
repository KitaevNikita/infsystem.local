@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-3">
        <h3 class="card-header">
        {{ $discipline->name_of_the_discipline }}&nbsp;({{ $discipline->teacher }})
        </h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Группа:</strong> {{ $discipline->group->namegroup }}</li>
            <li class="list-group-item"><strong>Количество часов:</strong> {{ $discipline->number_hours }}</li>
            <li class="list-group-item"><strong>Промежуточная аттестация:</strong> {{ $discipline->certification }}</li>
        </ul>
    </div>
    <div class="card">
        <h3 class="card-header">
            Отчет
        </h3>
        <div class="card-body">
                <summary-list :discipline_id="{{ $discipline->id }}"></summary-list>
        </div>
    </div> 
</div>

@endsection