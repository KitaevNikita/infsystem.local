@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h3 class="card-header">
            Список студентов
            <a class="btn btn-sm btn btn-success float-end" href="{{ route('admin.students.create') }}">
                <i class="bi bi-person-plus"> Добавить</i>
            </a>
        </h3>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Имя</th>
                        <th scope="col">Фамилия</th>
                        <th scope="col">Отчество</th>
                        <th scope="col" class="text-center">Номер студенческого билета</th>
                        <th scope="col" class="text-center">Группа</th>
                        <th scope="col" class="text-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                        <td>{{ $student->user->name }}</td>
                        <td>{{ $student->user->surname }}</td>
                        <td>{{ $student->user->patronymic }}</td>
                        <td class="text-center">{{ $student->number }}</td>
                        <td class="text-center">{{ $student->group->namegroup }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-secondary"
                            href="{{ route('admin.students.show', $student->id) }}"><i class="bi bi-eye"></i></a>&nbsp;
                            <a class="btn btn-sm btn-primary"
                            href="{{ route('admin.students.edit', $student->id) }}"><i class="bi bi-pencil"></i></a>&nbsp;
                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="post" class="float-end">
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
                            <h3 class="text-center">Текущие студенты отсутствуют</h3>
                        </td>
                        </tr>
                        @endforelse
                    </tbody>
            </table>
            @if($students->total() > $students->count())
            <div class="card-footer text-muted">
                {{ $students->links() }}
            </div>
            @endif
        </div>
    </div>
</div>            
@endsection
