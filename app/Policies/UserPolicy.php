<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определите, может ли пользователь просматривать модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->role == 'training') {
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
        // проверяем является ли пользователь администратором
        $isTraining = $user->role == 'training';

        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь обновить запись.
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\User $model запись пользователя
     *
     * @return boolean
     */
    public function update(User $user, User $model)
    {
        // проверяем является ли пользователь администратором
        $isTraining = $user->role == 'training';
        $isSelf = $user->id == $model->id;


        return $isTraining || $isSelf;
    }

    /**
     * Определить, может ли пользователь удалить запись
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\User $model запись пользователя
     *
     * @return boolean
     */
    public function delete(User $user, User $model)
    {
        // проверяем является ли пользователь администратором
        $isTraining = $user->role == 'training';
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь обновить модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function edit(User $user, User $model)
    {
        $isTraining = $user->role == 'training';
        $author = $model->id == $user->id;
        $role = $model->role == 'user';

        $result = $isTraining && ($author || $role);

        return $result;
    }
}
