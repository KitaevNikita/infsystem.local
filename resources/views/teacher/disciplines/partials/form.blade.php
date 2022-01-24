<form>
    <div class="mb-3">
        <label for="name_of_the_discipline">Название дисциплины <sup style="color: red">*</sup></label>
        <input type="text" class="form-control" id="name_of_the_discipline" name="name_of_the_discipline"
                value="{{ $discipline->name_of_the_discipline ?? old('name_of_the_discipline') }}">
    </div>
    <div class="mb-3">
        <label for="teacher">Ф.И.О.<sup style="color: red">*</sup></label>
        <input type="text" class="form-control" id="teacher" name="teacher"
                value="{{ $discipline->teacher ?? old('teacher') }}">
    </div>
    <div class="mb-3">
        <label for="number_hours">Количество часов<sup style="color: red">*</sup></label>
        <input type="text" class="form-control" id="number_hours" name="number_hours"
                value="{{ $discipline->number_hours ?? old('number_hours') }}">
    </div>
    <div class="mb-3">
        <label for="certification">Промежуточная аттестация<sup style="color: red">*</sup></label>
        <input type="text" class="form-control" id="certification" name="certification"
                value="{{ $discipline->certification ?? old('certification') }}">
    </div>
</form>
<hr>
<button type="submit" class="btn btn-primary">Сохранить</button>
<a class="btn btn-danger" href="{{ route('teacher.disciplines.index') }}">Отмена</a>
