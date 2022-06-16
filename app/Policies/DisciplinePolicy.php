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
        $isClassTeacher = $user->role == 'classteacher';

        // возвращаем результат проверки
        return $isTraining || $isTeacher || $isClassTeacher;
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
        $isTraining = $user->role == 'training';
        $isGroupForClassTeacher = false;
        if ($user->role == 'classteacher') {
            if ($model->group->classteacher_id == $user->id) {
                $isGroupForClassTeacher = true;
            }
        }
        $isDisciplineForTeacher = false;
        if ($user->role == 'teacher' && $user->isDisciplineConnected($model->id)) {
            $isDisciplineForTeacher = true;
        }
        return $isTraining || $isGroupForClassTeacher || $isDisciplineForTeacher;
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

        // возвращаем результат проверки
        return $isTraining;
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

        return $isTraining;
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

        return $isTraining;
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
        $isTraining = $user->role == 'training';
        $author = $model->id == $user->id;
        $role = $model->role == 'user';

        $result = $isTraining && ($author || $role);

        return $result;
    }

    public function getReport(User $user, Discipline $model)
    {
        $isTraining = $user->role == 'training';
        $isClassTeacher = $user->role == 'classteacher';
        $result = $isTraining || $isClassTeacher;
        return $result;
    }
}
