<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
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
        $isClassTeacher = $user->role == 'classteacher';

        // возвращаем результат проверки
        return $isTraining || $isClassTeacher;
    }

    /**
     * Определите, может ли пользователь просматривать модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Group  $model
     * @return mixed
     */
    public function view(User $user, Group $model)
    {
        $isTraining = $user->role == 'training';
        $isGroupForClassTeacher = false;
        if ($user->role == 'classteacher') {
            if ($model->classteacher_id == $user->id) {
                $isGroupForClassTeacher = true;
            }
        }
        return $isTraining || $isGroupForClassTeacher;
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
        // проверяем является ли пользователь учебной частью
        $isTraining = $user->role == 'training';

        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь обновить запись.
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Group $model запись пользователя
     *
     * @return boolean
     */
    public function update(User $user, Group $model)
    {
        // проверяем является ли пользователь учебной частью
        $isTraining = $user->role == 'training';
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь удалить запись
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Group $model запись пользователя
     *
     * @return boolean
     */
    public function delete(User $user, Group $model)
    {
        // проверяем является ли пользователь учебной частью
        $isTraining = $user->role == 'training';
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь обновить модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Group  $model
     * @return mixed
     */
    public function edit(User $user, Group $model)
    {
        $isTraining = $user->role == 'training';
        $author = $model->id == $user->id;
        $role = $model->role == 'user';

        $result = $isTraining && ($author || $role);

        return $result;
    }

    public function getStatement(User $user, Group $model)
    {
        $isClassTeacher = $user->role == 'classteacher';
        return $isClassTeacher;
    }
}
