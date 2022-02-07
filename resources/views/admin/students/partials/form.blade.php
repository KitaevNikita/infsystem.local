<div class="form-group">
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
<button type="submit" class="btn btn-primary">Сохранить</button>
<a class="btn btn-danger" href="{{ route('admin.students.index') }}">Отмена</a>
