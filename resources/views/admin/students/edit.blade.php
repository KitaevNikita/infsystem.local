@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Редактировать студента
        </h3>
        <div class="card-body">
            <form action="{{ route('admin.students.update', $user->id) }}" method="post">
                @csrf
                @method('put')

                @include('admin.users.partials.form', ['canEditRole' => false])
                @include('admin.students.partials.form')
            </form>
        </div>
    </div>
</div>

@endsection
