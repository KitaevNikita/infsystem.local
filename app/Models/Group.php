<?php

namespace App\Models;

use App\Models\Specialization;
use App\Models\Discipline;
use App\Models\Student;
use App\Models\Lessons;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namegroup',
        'specialization_id',
    ];

    protected $with = [
        'students',
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->isoFormat('D MMMM YYYY');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'classteacher_id');
    }
}