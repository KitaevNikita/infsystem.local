<?php

namespace App\Models;

use App\Models\Lesson;
use App\Models\User;
use App\Models\Discipline;
use App\Models\Summarylist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_of_the_discipline',
        'teacher',
        'number_hours',
        'certification',
        'group_id'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function students() 
    {
        return $this->hasMany(Student::class, 'summarylists', 'discipline_id', 'student_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'disciplines_teachers', 'discipline_id', 'teacher_id');
    }

    public function isTeacherConnected($teacher_id)
    {
        for ($i=0; $i < count($this->teachers); $i++) { 
            if ($this->teachers[$i]->id == $teacher_id) {
                return true;
            }
        }
        return false;
    }
}