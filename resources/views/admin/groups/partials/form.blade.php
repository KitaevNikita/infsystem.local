<div class="row ">
    <div class="col">
        <label for="namegroup">Название группы <sup style="color: red">*</sup></label>
        <input type="text" class="form-control @error('namegroup') is-invalid @enderror" id="namegroup" name="namegroup"
        value="{{ $group->namegroup ?? old('namegroup') }}">
        @error('namegroup')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror

        <div class="mb-3">
            <label for="specialization_id">Специальность<sup style="color: red">*</sup></label>
            <select class="form-select @error('specialization_id') is-invalid @enderror" id="specialization_id" name="specialization_id">
                @foreach($specializations as $specialization)
                    <option {{ (($group->specialization->id ?? old('specialization_id')) ==  $specialization->id) ? "selected" : "" }} value='{{$specialization->id}}'>
                        {{$specialization->namespec}}
                    </option>
                @endforeach
            </select>
            @error('specialization_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>
<hr>
<button type="submit" class="btn btn-primary"><i class="bi bi-save"> Сохранить</i></button>
<a class="btn btn-danger" href="{{ route('admin.groups.index') }}"><i class="bi bi-x-octagon"> На главную</i></a>
