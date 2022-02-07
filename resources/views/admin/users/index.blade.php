@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                    Список пользователей
                    <a class="btn btn-sm btn-success float-end" id="new" href="{{ route('admin.users.create') }}">
                    Добавить пользователя
                    </a>
                </h3>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Имя</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Роль</th>
                                <th scope="col" class="text-end">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-primary" id="show"
                                       href="{{ route('admin.users.show', $item->id) }}">
                                    Просмотреть
                                    </a>
                                    <a class="btn btn-sm btn-secondary" id="edit"
                                       href="{{ route('admin.users.edit', $item->id) }}">
                                    Редактировать
                                    </a>&nbsp;
                                    <form action="{{ route('admin.users.destroy', $item->id) }}"
                                     method="post" class="float-end">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" id="delete" type="submit">Удалить</button>
                                    </form>
                                </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center">Текущие пользователи отсутствуют</h3>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($items->total() > $items->count())
                <div class="card-footer text-muted">
                    {{ $items->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
