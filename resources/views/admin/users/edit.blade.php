@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                    Редактировать пользователя
                </h3>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="post">
                        @csrf
                        @method('put')

                        @include('admin.users.partials.form')
                        <hr>
                        <button type="submit" id="save" class="btn btn-primary"><i class="bi bi-save"></i> Сохранить</button>&nbsp;
                        <a class="btn btn-danger" href="{{ route('admin.users.index') }}"><i class="bi bi-house"></i> На главную</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
