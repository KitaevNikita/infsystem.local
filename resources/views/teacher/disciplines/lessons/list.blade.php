<table class="table table-bordered border-primary mt-4">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Ф.И.О.</th>
            <th scope="col">1 урок</th>
            @if($lesson->number_of_hours == 2)
            <th scope="col">2 урок</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($lesson->group->students as $student)
        <tr>
            <td scope="col">{{$loop->iteration}}</td>
            <td scope="col">{{$student->user->full_name}}</td>
            <td scope="col">
            <!-- <input type="text" class="form-control" id="estimation" name="estimation"
      value="{{ $summarylist->estimation ?? old('estimation') }}"> -->
            </td>
            @if($lesson->number_of_hours == 2)
            <td scope="col">

            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>