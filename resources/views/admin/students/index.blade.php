@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header bg-secondary text-white">
    Список студентов
    <a class="btn btn-sm btn btn-success float-right" href="{{ route('admin.students.create') }}">
    <i class="fa fa-plus-circle" aria-hidden="true"></i>
    </a>
  </div>
</div>
    <table class="table table-sm border">
      <thead class="thead-secondary">
        <tr>
          <th scope="col">Имя</th>
          <th scope="col">Фамилия</th>
          <th scope="col">Отчество</th>
          <th scope="col" class="text-center">Номер студенческого билета</th>
          <th scope="col" class="text-center">Группа</th>
          <th scope="col" class="text-right">Действия</th>
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
          <td class="text-right">
            <a class="btn btn-sm btn-secondary"
            href="{{ route('admin.students.show', $student->id) }}"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
            <a class="btn btn-sm btn-primary"
            href="{{ route('admin.students.edit', $student->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;
            <form action="{{ route('admin.students.destroy', $student->id) }}" method="post" class="float-right">
              @csrf
              @method('delete')
              <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-recycle" aria-hidden="true"></i></a>
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
@endsection
