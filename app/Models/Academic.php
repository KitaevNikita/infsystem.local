<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estimation',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}