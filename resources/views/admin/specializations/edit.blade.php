@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Редактировать специальность
        </h3>
        <div class="card-body">
            <form action="{{ route('admin.specializations.update', $specialization) }}" method="post">
                @csrf
                @method('put')

                @include('admin.specializations.partials.form')
            </form>
        </div>
    </div>
</div>
@endsection
