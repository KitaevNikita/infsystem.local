<?php

namespace App\Services;

use App\Models\User;

class Rights
{
    public static function canEditRole(User $user, User $editableUser) : bool
    {
        if ($user->role == 'training' && $editableUser->role != 'training') {
            return true;
        }
        return false;
    }
}