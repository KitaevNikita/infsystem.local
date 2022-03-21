<?php

namespace App\Models;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Academic;
use App\Models\Rate;
use App\Models\Group;
use Carbon\Carbon;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'topic',
        'type',
        'number_of_hours',
        'discipline_id',
        'group_id'
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function students() 
    {
        return $this->belongsToMany(Student::class, 'students_lessons', 'lesson_id', 'student_id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function getDisplayDateAttribute()
    {
        return Carbon::parse($this->date)->isoFormat('D MMMM YYYY');
    }
}