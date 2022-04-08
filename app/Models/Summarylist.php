<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summarylist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'interim',
        'estimation',
        'discipline_id',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}