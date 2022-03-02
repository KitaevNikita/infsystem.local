@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
            Список учебных дисциплин
            @can('training')
                <a class="btn btn-sm btn btn-success float-end" href="{{ route('teacher.disciplines.create') }}"><i class="bi bi-plus-square"> Добавить</i></a>
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
                        <td>{{ Str::limit($discipline->name_of_the_discipline, 25) }}</td>
                        <td>{{ $discipline->teacher }}</td>
                        <td class="text-center">{{ $discipline->number_hours }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-secondary"
                            href="{{ route('teacher.disciplines.show', $discipline) }}">
                                @if(Auth::user()->hasRole(Auth::user()::TRAINING))
                                    <i class="bi bi-eye"></i>
                                @elseif(Auth::user()->hasRole(Auth::user()::TEACHER))
                                    <i class="bi bi-journal-plus">Провести</i>
                                @endif
                            </a>
                            @can('training')
                            <a class="btn btn-sm btn-primary"
                            href="{{ route('teacher.disciplines.edit', $discipline) }}"><i class="bi bi-pencil"></i></a>&nbsp;
                        <form action="{{ route('teacher.disciplines.destroy', $discipline) }}" method="post" class="float-end">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i></a>
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