@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Редактировать дисциплину
        </h3>
        <div class="card-body">
            <form action="{{ route('teacher.disciplines.update', $discipline) }}" method="post">
                @csrf
                @method('put')

                @include('teacher.disciplines.partials.form')
            </form>
        </div>
    </div>
</div>
@endsection
