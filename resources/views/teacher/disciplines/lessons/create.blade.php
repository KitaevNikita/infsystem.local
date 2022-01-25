@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

<form action="{{ route('teacher.lessons.store', $discipline) }}" method="post">
    @csrf

    @include('teacher.disciplines.lessons.partials.form')
</form>

@endsection
