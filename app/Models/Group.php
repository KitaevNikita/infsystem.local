<?php

namespace App\Models;

use App\Models\Specialization;
use App\Models\Discipline;
use App\Models\Student;
use App\Models\Lessons;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'discipline_id',
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
}