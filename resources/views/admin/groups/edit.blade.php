@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Редактировать группу
        </h3>
        <div class="card-body">
            <form action="{{ route('admin.groups.update', $group) }}" method="post">
                @csrf
                @method('put')

                @include('admin.groups.partials.form')
            </form>
        </div>
    </div>
</div>
@endsection