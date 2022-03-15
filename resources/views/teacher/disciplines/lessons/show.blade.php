@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

<ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Тема:</strong> {{ $lesson->topic }}</li>
    <li class="list-group-item"><strong>Количество часов:</strong> {{ $lesson->number_of_hours }}</li>
    <li class="list-group-item"><strong>Тип:</strong> {{ $lesson->type }}</li>
    <li class="list-group-item"><strong>Дата:</strong> {{ $lesson->date }}</li>
</ul>
<a class="btn btn-secondary" href="{{ route('teacher.lessons.edit', [$discipline, $lesson]) }}">
    <i class="bi bi-pencil"> Редактировать</i>
</a>
<a class="btn btn-danger" href="{{ route('teacher.disciplines.show', $discipline) }}">
    <i class="bi bi-x-octagon"> На главную</i>
</a>

@include('teacher.disciplines.lessons.list')

@endsection
