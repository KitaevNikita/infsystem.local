<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AcademicController;
use App\Http\Controllers\SummarylistController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::redirect('/', '/login');

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes...
Route::get('password/reset', [LoginController::class, 'showLinkRequestForm']);
Route::post('password/email', [LoginController::class, 'sendResetLinkEmail']);
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

$adminGroupData = [
    'as' => 'admin.',
    'middleware' => 'auth',
];

Route::group($adminGroupData, function () {
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('specializations', SpecializationController::class);
});

$teacherGroupData = [
    'as' => 'teacher.',
    'middleware' => 'auth',
];

Route::group($teacherGroupData, function () {
    Route::resource('disciplines', DisciplineController::class);
    Route::resource('disciplines/{discipline}/lessons', LessonController::class)->except('index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

