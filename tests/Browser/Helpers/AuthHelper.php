<?php

namespace Tests\Browser\Helpers;

use App\Models\User;

class AuthHelper
{
    public static function getUserWithRole(string $roleName) : User
    {
        $user = User::where('role', $roleName)->first();
        if($user === null)
        {
            if($roleName == 'training')
            {
                $user = User::factory()
                    ->count(1)
                    ->training()
                    ->create();
            }
            else if($roleName == 'teacher')
            {
                $user = User::factory()
                    ->count(1)
                    ->teacher()
                    ->create();
            }
            else if($roleName == 'student')
            {
                $user = User::factory()
                    ->count(1)
                    ->student()
                    ->create();
            }
        }
        return $user;
    }
}