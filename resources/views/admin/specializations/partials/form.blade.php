<div class="row ">
    <div class="col">
        <label for="namespec">Название специальности <sup style="color: red">*</sup></label>
        <input type="text" class="form-control @error('namespec') is-invalid @enderror" id="namespec" name="namespec"
        value="{{ $specialization->namespec ?? old('namespec') }}">
        @error('namespec')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
</div>
<hr>
<button type="submit" class="btn btn-primary"><i class="bi bi-save"> Сохранить</i></button>&nbsp;
<a class="btn btn-danger" href="{{ route('admin.specializations.index') }}"><i class="bi bi-house"> На главную</i></a>
