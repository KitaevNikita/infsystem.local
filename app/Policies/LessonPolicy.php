<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
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
        // проверяем является ли пользователь преподавателем
         $isTeacher = $user->role == 'teacher';

        // возвращаем результат проверки
        return $isTeacher;
    }

    /**
     * Определите, может ли пользователь просматривать модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lesson  $model
     * @return mixed
     */
    public function view(User $user, Lesson $model)
    {
        if ($model->role == 'teacher') {
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
        // проверяем является ли пользователь преподавателем
         $isTeacher = $user->role == 'teacher';
        // возвращаем результат проверки
        return $isTeacher;
    }

    /**
     * Определить, может ли пользователь обновить запись.
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Lesson $model запись пользователя
     *
     * @return boolean
     */
    public function update(User $user, Lesson $model)
    {
        // проверяем является ли пользователь преподавателем
         $isTeacher = $user->role == 'teacher';
        // возвращаем результат проверки
        return $isTeacher;
    }

    /**
     * Определить, может ли пользователь удалить запись
     *
     * @param \App\Models\User $user  авторизованный пользователь
     * @param \App\Models\Lesson $model запись пользователя
     *
     * @return boolean
     */
    public function delete(User $user, Lesson $model)
    {
        // проверяем является ли пользователь преподавателем
         $isTeacher = $user->role == 'teacher';
        // возвращаем результат проверки
        return $isTeacher;
    }

    /**
     * Определить, может ли пользователь обновить модель.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lesson  $model
     * @return mixed
     */
    public function edit(User $user, Lesson $model)
    {
        $isTeacher = $user->role == 'teacher';
        $author = $model->id == $user->id;
        $role = $model->role == 'user';

        $result = $isTeacher && ($author || $role);

        return $result;
    }
}
