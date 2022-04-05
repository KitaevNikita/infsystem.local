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

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="card bg-dark text-white">
            <img src="/img/preview2.jpg" class="card-img" alt="">   
        </div>
    </div>
</div>

@endsection
