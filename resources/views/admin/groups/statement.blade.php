@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <h3 class="card-header">
        Сводная ведомость
        </h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center align-middle">№ п/п</th>
                        <th scope="col" rowspan="2" class="text-center align-middle">Ф. И. О.</th>
                        <th scope="col" colspan="2" class="text-center">Семестровые оценки</th>
                        <th scope="col" colspan="2" class="text-center">Промежуточная аттестия</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">Литература</th>
                        <th scope="col" class="text-center">Физика</th>
                        <th scope="col" class="text-center">Литература</th>
                        <th scope="col" class="text-center">Физика</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" class="text-center">1</td>
                        <td>Токарев Егор Владимирович</td>
                        <td class="text-center"></td>
                        <td class="text-center">5</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td scope="row" class="text-center">2</td>
                        <td>Ортюков Дмитрий Александрович</td>
                        <td class="text-center"></td>
                        <td class="text-center">2</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection