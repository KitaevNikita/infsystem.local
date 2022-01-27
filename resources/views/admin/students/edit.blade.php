@extends('layouts.app')

@section('content')

<div class="card">
  <h3 class="card-header">
    Редактировать задачу
  </h3>
  <div class="card-body">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @component('components.error', [
                'message' => $error,
            ])
            @endcomponent
        @endforeach
    @endif

    <form action="{{ route('admin.students.update', $student->id) }}" method="post">
      @csrf
      @method('put')

      @include('admin.students.partials.form')
    </form>
  </div>
</div>

@endsection
