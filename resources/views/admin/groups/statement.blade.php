@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
        Сводная ведомость
        <a class="btn btn-sm btn btn-primary float-end d-inline-block ms-1" href="javascript:(print());" onclick="window.print();return false;">
            <i class="bi bi-printer"></i> Печать
        </a>
        <a class="btn btn-sm btn btn-danger float-end" href="{{ route('admin.groups.index') }}">
            <i class="bi bi-house"></i> Вернуться
        </a>
        </h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="statement-table">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center align-middle">№ п/п</th>
                        <th scope="col" rowspan="2" class="text-center align-middle">Ф. И. О.</th>
                        <th scope="col" colspan="{{ count($group->disciplines) }}" class="text-center">Семестровые оценки</th>
                        <th scope="col" colspan="{{ count($group->disciplines) }}" class="text-center">Промежуточная аттестия</th>
                    </tr>
                    <tr>
                        @for($i = 0; $i < 2; $i++)
                            @foreach($group->disciplines as $discipline)
                                <th scope="col" class="text-center align-middle">{{ $discipline->name_of_the_discipline }}</th>
                            @endforeach
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($group->students as $student)
                    <tr>
                        <td scope="row" class="text-center align-middle">{{ $loop->iteration }}</td>
                        <td>{{ $student->user->full_name }}</td>
                            @foreach($group->disciplines as $discipline)
                                <td class="text-center align-middle">{{ \App\Models\Summarylist::getEstimation($discipline->id, $student->id) }}</td>
                            @endforeach
                            @foreach($group->disciplines as $discipline)
                                <td class="text-center align-middle">{{ \App\Models\Summarylist::getInterim($discipline->id, $student->id) }}</td>
                            @endforeach
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection