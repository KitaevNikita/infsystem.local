<div class="form-group">
<div class="row mt-3">
    <div class="col">
    <label for="number">Номер студенческого<sup style="color: red">*</sup></label>
    <input type="text" class="form-control  @error('number') is-invalid @enderror" id="number" name="number"
    value="{{ $user->student->number ?? old('number') }}">
    @error('number')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
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
</div>
<hr>
<button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Сохранить</button>&nbsp;
<a class="btn btn-danger" href="{{ route('admin.students.index') }}"><i class="bi bi-house"></i>  На главную</a>
