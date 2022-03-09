<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Specialization;
use App\Policies\SpecializationPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Specialization::class => SpecializationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('training', function ($user) {
            if ($user->role == 'training') {
                return true;
            }
            return false;
        });
        Gate::define('teacher', function ($user) {
            if ($user->role == 'teacher') {
                return true;
            }
            return false;
        });
        Gate::define('student', function ($user) {
            if ($user->role == 'student') {
                return true;
            }
            return false;
        });
    }
}
