<?php

namespace App\Models;

use App\Models\Lesson;
use App\Models\Discipline;
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
        'discipline_id',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}