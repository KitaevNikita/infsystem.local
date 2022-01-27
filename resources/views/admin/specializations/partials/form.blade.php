<form>
    <div class="row ">
        <div class="col">
            <label for="namespec">Название специальности <sup style="color: red">*</sup></label>
            <input type="text" class="form-control" id="namespec" name="namespec"
            value="{{ $specialization->namespec ?? old('namespec') }}">
        </div>
    </div>
</form>
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<hr>
<button type="submit" class="btn btn-primary">Сохранить</button>
<a class="btn btn-danger" href="{{ route('admin.specializations.index') }}">Отменить</a>
