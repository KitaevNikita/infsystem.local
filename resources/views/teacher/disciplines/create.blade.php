@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Добавить дисциплину
        </h3>
        <div class="card-body">
            <form action="{{ route('teacher.disciplines.store') }}" method="post">
                @csrf

                @include('teacher.disciplines.partials.form')
            </form>
        </div>
    </div>
</div>
@endsection
