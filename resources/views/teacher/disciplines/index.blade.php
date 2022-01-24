@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Список учебных дисциплин
            @can('training')
                <a class="btn btn-sm btn btn-success float-end" href="{{ route('teacher.disciplines.create') }}">Добавить дисциплину</a>
            @endcan
            </h3>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Дисциплина</th>
                        <th scope="col">ФИО</th>
                        <th scope="col" class="text-center">Кол-во часов</th>
                        <th scope="col" class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($disciplines as $discipline)
                        <tr>
                        <td>{{ $discipline->name_of_the_discipline }}</td>
                        <td>{{ $discipline->teacher }}</td>
                        <td class="text-center">{{ $discipline->number_hours }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-secondary"
                            href="{{ route('teacher.disciplines.show', $discipline) }}">
                                @if(Auth::user()->hasRole(Auth::user()::TRAINING))
                                    Просмотреть
                                @elseif(Auth::user()->hasRole(Auth::user()::TEACHER))
                                    Провести занятие
                                @endif
                            </a>
                            @can('training')
                            <a class="btn btn-sm btn-primary"
                            href="{{ route('teacher.disciplines.edit', $discipline) }}">Редактировать</a>&nbsp;
                        <form action="{{ route('teacher.disciplines.destroy', $discipline) }}" method="post" class="float-end">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger" type="submit">Удалить</a>
                            @endcan
                        </form>
                        </td>
                        </tr>
                            @empty
                        <tr>
                            <td colspan="12">
                                    <h3 class="text-center">Текущие дисциплины отсутствуют</h3>
                            </td>
                        </tr>
                            @endforelse
                    </tbody>
            </table>
                    @if($disciplines->total() > $disciplines->count())
                <div class="card-footer text-muted">
                    {{ $disciplines->links() }}
                </div>
            @endif
        </div>    
    </div>
</div>

@endsection