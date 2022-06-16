<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'surname',
        'name',
        'patronymic',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const TRAINING = 'training';
    public const TEACHER = 'teacher';
    public const STUDENT = 'student';
    public const CLASSTEACHER = 'classteacher';

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->surname} {$this->name} {$this->patronymic}";
    }

    public function getRoleNameAttribute()
    {
        if($this->role == 'teacher') {
            return 'Преподаватель';
        }elseif ($this->role == 'student') {
            return 'Студент';
        }elseif ($this->role == 'training') {
            return 'Учебная часть';
        }elseif ($this->role == 'classteacher') {
            return 'Классный руководитель';
        }
    }

    /**
     * Получить телефон, связанный с пользователем.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function hasRole(string $name)
    {
        if($this->role == $name)
            return true;
        return false;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->isoFormat('D MMMM YYYY');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->isoFormat('D MMMM YYYY');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}