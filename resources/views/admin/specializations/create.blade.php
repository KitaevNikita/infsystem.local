@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Добавить специальность
        </h3>
        <div class="card-body">
            <form action="{{ route('admin.specializations.store') }}" method="post">
                @csrf

                @include('admin.specializations.partials.form')
            </form>
        </div>
    </div>
</div>
@endsection
