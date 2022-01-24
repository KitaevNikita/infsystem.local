@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                    Редактировать дисциплину
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

                    <form action="{{ route('teacher.disciplines.update', $discipline) }}" method="post">
                        @csrf
                        @method('put')

                        @include('teacher.disciplines.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
