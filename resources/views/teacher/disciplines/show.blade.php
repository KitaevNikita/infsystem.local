@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

@include('teacher.disciplines.lessons.index')

<summary-list :discipline_id="{{ $discipline->id }}"></summary-list> 

@endsection