@extends('teacher.disciplines.layouts.discipline-layout')

@section('discipline-content')

<div class="card">
  <div class="card-body">
        <summary-list :discipline_id="{{ $discipline->id }}"></summary-list>
  </div>
</div> 

@include('teacher.disciplines.lessons.index')

@endsection