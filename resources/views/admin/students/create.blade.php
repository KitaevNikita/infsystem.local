@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Добавить студента
        </h3>
            <div class="card-body">
            <form action="{{ route('admin.students.store') }}" method="post">
                @csrf

                @include('admin.users.partials.form')
                @include('admin.students.partials.form')
            </form>
        </div>
    </div>
</div>

@endsection