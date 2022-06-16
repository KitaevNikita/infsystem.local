<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Specialization;
use App\Policies\SpecializationPolicy;
use App\Models\Student;
use App\Policies\StudentPolicy;
use App\Models\Group;
use App\Policies\GroupPolicy;
use App\Models\Lesson;
use App\Policies\LessonPolicy;
use App\Models\Discipline;
use App\Policies\DisciplinePolicy;


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
        Student::class => StudentPolicy::class,
        Group::class => GroupPolicy::class,
        Lesson::class => LessonPolicy::class,
        Discipline::class => DisciplinePolicy::class,
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
        Gate::define('classteacher', function ($user) {
            if ($user->role == 'classteacher') {
                return true;
            }
            return false;
        });
    }
}
