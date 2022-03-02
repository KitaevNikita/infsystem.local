@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h3 class="card-header">
            Список специальностей
            <a class="btn btn-sm btn btn-success float-end" href="{{ route('admin.specializations.create') }}">
                <i class="bi bi-plus-square"> Добавить</i>
            </a>
        </h3>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Название специальности</th>
                        <th scope="col" class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>   
                    @forelse($specializations as $specialization)
                    <tr>
                    <td>{{ $specialization->namespec }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.specializations.show', $specialization) }}">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a class="btn btn-sm btn-primary"
                        href="{{ route('admin.specializations.edit', $specialization) }}">
                            <i class="bi bi-pencil"></i>
                        </a>&nbsp;
                        <form action="{{ route('admin.specializations.destroy', $specialization) }}" method="post" class="float-end">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                    @csrf
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <h3 class="text-center">Текущие специальности отсутствуют</h3>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>    
    </div>
</div>
@endsection
