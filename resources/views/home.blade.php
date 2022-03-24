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
            <img src="/img/preview2.jpg" class="card-img" alt="">   
        </div>
    </div>
</div>

@endsection
