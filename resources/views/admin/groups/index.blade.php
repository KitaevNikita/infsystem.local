@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h3 class="card-header">
            Список группы
            <a class="btn btn-sm btn btn-success float-end" href="{{ route('admin.groups.create') }}">
                Добавить группу
            </a>
        </h3>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Название группы</th>
                        <th scope="col" class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>   
                    @forelse($groups as $group)
                    <tr>
                    <td>{{ $group->namegroup }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.groups.show', $group) }}">Просмотреть</a>
                        <a class="btn btn-sm btn-primary"
                        href="{{ route('admin.groups.edit', $group) }}">Редактировать</a>&nbsp;
                        <form action="{{ route('admin.groups.destroy', $group) }}" method="post" class="float-end">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" type="submit">Удалить</a>
                        </form>
                    </td>
                    @csrf
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <h3 class="text-center">Текущие группы отсутствуют</h3>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>    
    </div>
</div>
@endsection
