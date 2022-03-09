<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
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
        // проверяем является ли пользователь учебной частью
         $isTraining = $user->role == 'training';

        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определите, может ли пользователь просматривать модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Student  $model
     * @return mixed
     */
    public function view(User $user, Student $model)
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
        // проверяем является ли пользователь учебной частью
         $isTraining = $user->role == 'training';
        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь обновить запись.
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Student $model запись пользователя
     *
     * @return boolean
     */
    public function update(User $user, Student $model)
    {
        // проверяем является ли пользователь учебной частью
         $isTraining = $user->role == 'training';
        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь удалить запись
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Student $model запись пользователя
     *
     * @return boolean
     */
    public function delete(User $user, Student $model)
    {
        // проверяем является ли пользователь учебной частью
         $isTraining = $user->role == 'training';
        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь обновить модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Student  $model
     * @return mixed
     */
    public function edit(User $user, Student $model)
    {
        $isTraining = $user->role == 'training';
        $author = $model->id == $user->id;
        $role = $model->role == 'user';

        $result = $isTraining && ($author || $role);

        return $result;
    }
}
