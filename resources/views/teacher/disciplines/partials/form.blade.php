<div class="mb-3">
    <label for="name_of_the_discipline">Название дисциплины <sup style="color: red">*</sup></label>
    <input type="text" class="form-control @error('name_of_the_discipline') is-invalid @enderror" id="name_of_the_discipline" name="name_of_the_discipline"
            value="{{ $discipline->name_of_the_discipline ?? old('name_of_the_discipline') }}">
    @error('name_of_the_discipline')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="teacher">Ф.И.О.<sup style="color: red">*</sup></label>
    <input type="text" class="form-control @error('teacher') is-invalid @enderror" id="teacher" name="teacher"
            value="{{ $discipline->teacher ?? old('teacher') }}">
    @error('teacher')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="number_hours">Количество часов</label>
    <input type="text" class="form-control @error('number_hours') is-invalid @enderror" id="number_hours" name="number_hours"
            value="{{ $discipline->number_hours ?? old('number_hours') }}">
    @error('number_hours')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3 mt-3">
    <label for="group_id">Группа</label>
    <select class="form-select @error('group_id') is-invalid @enderror" id="group_id" name="group_id">
        @foreach($groups as $group)
            <option {{ (($user->student->group_id ?? old('group_id')) ==  $group->id) ? "selected" : "" }} value='{{$group->id}}'>
                {{$group->namegroup}}
            </option>
        @endforeach
    </select>
    @error('group_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3 mt-3">
    <label for="teachers">Преподаватели</label>
    <select class="form-select @error('teachers') is-invalid @enderror" id="teachers" name="teachers[]" multiple>
        @foreach($teachers as $teacher)
            <option @if(isset($discipline) &&  $discipline->isTeacherConnected($teacher->id)) selected @endif value='{{$teacher->id}}'>
                {{$teacher->full_name}}
            </option>
        @endforeach
    </select>
    @error('group_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="certification">Промежуточная аттестация<sup style="color: red">*</sup></label>
    <select class="form-select @error('certification') is-invalid @enderror" id="certification" name="certification">
        <option {{ (($discipline->certification ?? old('certification')) == "Зачет") ? "selected" : "" }}>
            Зачет
        </option>
        <option {{ (($discipline->certification ?? old('certification')) == "Дифференцированный зачет") ? "selected" : "" }}>
            Дифференцированный зачет
        </option>
        <option {{ (($discipline->certification ?? old('certification')) == "Экзамен") ? "selected" : "" }}>
            Экзамен
        </option>
    </select>
    @error('certification')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<hr>
<button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Сохранить</button>&nbsp;
<a class="btn btn-danger" href="{{ route('teacher.disciplines.index') }}"><i class="bi bi-house"></i> На главную</a>

