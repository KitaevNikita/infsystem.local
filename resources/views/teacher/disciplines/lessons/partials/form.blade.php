<div class="mb-3">
    <label for="topic">Тема <sup style="color: red">*</sup></label>
    <input type="text" class="form-control @error('topic') is-invalid @enderror" id="topic" name="topic"
            value="{{ $lesson->topic ?? old('topic') }}">
    @error('topic')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3">
    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
        <option>Теоретический</option>
        <option>Практический</option>
        <option>Теоретико-практический</option>
    </select>
    @error('type')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="mb-3">
    <select class="form-select @error('group_id') is-invalid @enderror" id="group_id" name="group_id">
    @foreach($groups as $group)
        <option value='{{$group->id}}'>{{$group->namegroup}}</option>
    @endforeach
    </select>
    @error('group_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="number_of_hours">Количество часов<sup style="color: red">*</sup></label>
    <input type="number" min="1" max="2" class="form-control @error('number_of_hours') is-invalid @enderror" id="number_of_hours" name="number_of_hours"
            value="{{ $lesson->number_of_hours ?? old('number_of_hours') }}">
    @error('number_of_hours')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="date">Дата проведения<sup style="color: red">*</sup></label>
    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
            value="{{ $lesson->date ?? old('date') }}">
    @error('date')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary"><i class="bi bi-save"> Сохранить</i></button>
<a class="btn btn-danger" href="{{ route('teacher.disciplines.show', $discipline) }}"><i class="bi bi-house"> На главную</i></a>


