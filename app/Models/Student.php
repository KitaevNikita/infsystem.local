<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Models\Group;
use App\Models\Discipline;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'number',
        'group_id',
    ];

    /**
     * Пользователь, к которому приналежит студент/
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons() 
    {
        return $this->belongsToMany(Lesson::class, 'students_lessons', 'student_id', 'lesson_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function disciplines() 
    {
        return $this->belongsToMany(Discipline::class, 'summarylists', 'student_id', 'discipline_id');
    }
}