@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Добавить группу
        </h3>
            <div class="card-body">
            <form action="{{ route('admin.groups.store') }}" method="post">
                @csrf

                @include('admin.groups.partials.form')
            </form>
        </div>
    </div>
</div>

@endsection