<form class="container">
<div class="form-group">
      <label for="user_id">Список студентов</label>
          <select class="form-control" name="user_id" id="user_id">
            @if(preg_match('/create/', Request::path()))
              @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->full_name }}</option>
              @endforeach
              @else
                  <option value="{{ $student->id }}">{{ $student->user->full_name }}</option>
            @endif
          </select>
      </div>
  <div class="row mt-3">
    <div class="col">
      <label for="number">Номер студенческого<sup style="color: red">*</sup></label>
      <input type="text" class="form-control" id="number" name="number"
      value="{{ $student->number ?? old('number') }}">
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <label for="namegroup">Группа<sup style="color: red">*</sup></label>
      <input type="text" class="form-control" id="namegroup" name="namegroup"
      value="{{ $student->group->namegroup ?? old('namegroup') }}">
    </div>
  </div>
<hr>
<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
<a class="btn btn-danger" href="{{ route('admin.students.index') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
