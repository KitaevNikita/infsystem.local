@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

    <form action="{{ route('teacher.lessons.update', [$discipline, $lesson]) }}" method="post">
        @csrf

        @method('put')

        @include('teacher.disciplines.lessons.partials.form')
    </form>
    
@endsection
