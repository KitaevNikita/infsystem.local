<div class="form-row">
    <div class="form-group col">
        <label for="surname">Фамилия</label>
        <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname"
        value="{{ $user->surname ?? old('surname')}}">
        @error('surname')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="form-group col">
        <label for="name">Имя</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ $user->name ?? old('name')}}">
        @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="form-group col">
        <label for="patronymic">Отчество</label>
        <input type="text" class="form-control @error('patronymic') is-invalid @enderror" id="patronymic" name="patronymic"
        value="{{ $user->patronymic ?? old('patronymic')}}">
        @error('patronymic')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
    value="{{ $user->email ?? old('email')}}">
    @error('email')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="password">Пароль</label>
    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
    @error('password')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div>
    <label for="role">Роль</label>
    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
        @cannot('teacher')
        <option value="student" {{ (($user->role ?? old('role')) == "student") ? "selected" : "" }}>
            Студент
        </option>
        @endcannot
        @cannot('student')
        <option value="teacher" {{ (($user->role ?? old('role')) == "teacher") ? "selected" : "" }}>
            Преподаватель
        </option>
        @cannot('teacher')
        <option value="training" {{ (($user->role ?? old('role')) == "training") ? "selected" : "" }}>
            Учебная часть
        </option>
        @endcannot
        @endcannot
    </select>
    @error('role')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

