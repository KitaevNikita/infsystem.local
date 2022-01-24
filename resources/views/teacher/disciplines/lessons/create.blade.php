@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

<form action="{{ route('teacher.lessons.store', $discipline) }}" method="post">
    @csrf

    @include('teacher.disciplines.lessons.partials.form')

    <hr>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a class="btn btn-danger" href="{{ route('teacher.disciplines.show', $discipline) }}">Отмена</a>
</form>

@endsection