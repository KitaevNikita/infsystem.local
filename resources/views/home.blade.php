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
    <h1 class="display-4">"Электонный журнал"</h1>
    <p class="lead">Данный журнал представляет собой удобство и простоту ипользования и переход от бумажной версии к электронной.</p>
  </div>
</div>

@endsection
