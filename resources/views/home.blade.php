@extends('layouts.app')

@section('content')

<div class="container">
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                @component('components.error', [
                    'message' => $error,
                ])

            @endcomponent
        @endforeach
    @endif
</div>

<div class="container py-4">
    <div class="p-5 mb-4 bg-light rounded-3 border border-secondary">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Электронный журнал</h1>
            <p class="col-md-8 fs-4">Информационная система, которая предназначена для упрощения работы преподавателя.</p>
        </div>
    </div>
</div>

@endsection
