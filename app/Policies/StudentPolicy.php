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
        // проверяем является ли пользователь Ведущим программистом или программистом
         $isTraining = $user->role == 'training';

        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определите, может ли пользователь просматривать записи.
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\User $model запись пользователя
     *
     * @return boolean
     */
    public function view(User $user)
    {
        // проверяем является ли пользователь Ведущим программистом или программистом
         $isTraining = $user->role == 'training';

        // возвращаем результат проверки
        return $isSenior;
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
        // проверяем является ли пользователь Ведущим программистом
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
    public function update(User $user)
    {
        // проверяем является ли пользователь Ведущим программистом или программистом
         $isTraining = $user->role == 'training';
        // возвращаем результат проверки
        return $isTraining;
    }

    /**
     * Определить, может ли пользователь удалить запись
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\User $model запись пользователя
     *
     * @return boolean
     */
    public function delete(User $user)
    {
        // проверяем является ли пользователь Ведущим программистом
         $isTraining = $user->role == 'training';
        // возвращаем результат проверки
        return $isTraining;
    }
}
