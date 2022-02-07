<div class="form-row">
    <div class="form-group col">
        <label for="surname">Фамилия</label>
        <input type="text" class="form-control" id="surname" name="surname"
        value="{{ $item->surname ?? old('surname')}}">
    </div>
    <div class="form-group col">
        <label for="name">Имя</label>
        <input type="text" class="form-control" id="name" name="name"
        value="{{ $item->name ?? old('name')}}">
    </div>
    <div class="form-group col">
        <label for="patronymic">Отчество</label>
        <input type="text" class="form-control" id="patronymic" name="patronymic"
        value="{{ $item->patronymic ?? old('patronymic')}}">
    </div>
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control" id="email" name="email"
    value="{{ $item->email ?? old('email')}}">
</div>
<div class="form-group">
    <label for="password">Пароль</label>
    <input type="text" class="form-control" id="password" name="password">
</div>
<div class="form-group">
    <label for="role">Роль</label>
    <select class="form-select" id="role" name="role">
        @cannot('teacher')
        <option value="student" {{ (($item->role ?? old('role')) == "student") ? "selected" : "" }}>
            Студент
        </option>
        @endcannot
        @cannot('student')
        <option value="teacher" {{ (($item->role ?? old('role')) == "teacher") ? "selected" : "" }}>
            Преподаватель
        </option>
        @cannot('teacher')
        <option value="training" {{ (($item->role ?? old('role')) == "training") ? "selected" : "" }}>
            Учебная часть
        </option>
        @endcannot
        @endcannot
    </select>
</div>

