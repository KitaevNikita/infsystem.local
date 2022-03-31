<?php

namespace App\Policies;

use App\Models\Discipline;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisciplinePolicy
{
    use HandlesAuthorization;

    /**
     * Определите, может ли пользователь просматривать список записей.
     *
     * @param \App\Models\User $user авторизованный пользователь
     *
     * @return boolean результат проверки
     */
    public function viewAny(User $user)
    {
        // проверяем является ли пользователь владельцем
        $isTraining = $user->role == 'training';
        $isTeacher = $user->role == 'teacher';

        // возвращаем результат проверки
        return $isTraining || $isTeacher;
    }

    /**
     * Определите, может ли пользователь просматривать модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discipline  $model
     * @return mixed
     */
    public function view(User $user, Discipline $model)
    {
        if ($model->role == 'training') {
            return true;
        }
        return null;
    }

    /**
     * Определить, может ли пользователь создавать записи.
     *
     * @param \App\Models\User $user авторизованный пользователь
     *
     * @return boolean
     */
    public function create(User $user)
    {
        // проверяем является ли пользователь учебной частью или преподавателем
        $isTraining = $user->role == 'training';
        $isTeacher = $user->role == 'teacher';

        // возвращаем результат проверки
        return $isTraining || $isTeacher;
    }

    /**
     * Определить, может ли пользователь обновить запись.
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Discipline $model запись пользователя
     *
     * @return boolean
     */
    public function update(User $user, Discipline $model)
    {
        // проверяем является ли пользователь учебной частью или преподавателем
        $isTraining = $user->role == 'training';
        $isTeacher = $user->role == 'teacher';

        return $isTraining || $isTeacher;
    }

    /**
     * Определить, может ли пользователь удалить запись
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Discipline $model запись пользователя
     *
     * @return boolean
     */
    public function delete(User $user, Discipline $model)
    {
        // проверяем является ли пользователь учебной частью или преподавателем
        $isTraining = $user->role == 'training';
        $isTeacher = $user->role == 'teacher';

        return $isTraining || $isTeacher;
    }

    /**
     * Определить, может ли пользователь обновить модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discipline  $model
     * @return mixed
     */
    public function edit(User $user, Discipline $model)
    {
        return true;
        $isTraining = $user->role == 'training';
        $isTeacher = $user->role == 'teacher';
        $author = $model->id == $user->id;
        $role = $model->role == 'user';

        $result = $isTeacher || $isTraining && ($author || $role);

        return $result;
    }
}
