@extends('layouts.app')

@section('content')

@if ($errors->any())
        @foreach ($errors->all() as $error)
            @component('components.error', [
                'message' => $error,
            ])

            @endcomponent
        @endforeach
  @endif

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="card bg-dark text-white">
        <img src="/img/preview.png" class="card-img" alt="">
            <div class="card-img-overlay">
                <h5 class="card-title">Электонный журнал</h5>
                <p class="card-text">Данный журнал представляет собой электронный вариант всем известного бумажного журнала.</p>
            </div>
        </div>
    </div>
</div>

@endsection
