@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

<ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Тема:</strong> {{ $lesson->topic }}</li>
    <li class="list-group-item"><strong>Количество часов:</strong> {{ $lesson->number_of_hours }}</li>
    <li class="list-group-item"><strong>Группа:</strong> {{ $lesson->discipline->group->namegroup }}</li>
    <li class="list-group-item"><strong>Тип:</strong> {{ $lesson->type }}</li>
    <li class="list-group-item"><strong>Дата:</strong> {{ $lesson->display_date }}</li>
</ul>
<a class="btn btn-secondary d-inline-block me-1 text-light" href="{{ route('teacher.lessons.edit', [$discipline, $lesson]) }}">
    <i class="bi bi-pencil"></i> Редактировать
</a>
<a class="btn btn-danger" href="{{ route('teacher.disciplines.show', $discipline) }}">
<i class="bi bi-house"></i> Назад
</a>

<lesson :discipline_id="{{$discipline->id}}" :lesson_id="{{$lesson->id}}"></lesson>

@endsection
