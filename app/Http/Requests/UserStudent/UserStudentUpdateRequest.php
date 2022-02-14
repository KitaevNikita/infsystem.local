<?php

namespace App\Http\Requests\UserStudent;

use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\StudentRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserStudentUpdateRequest extends UserStudentStoreRequest
{
    public function __construct()
    {
        $this->userStoreRequest = new UserUpdateRequest();
        $this->studentRequest = new StudentRequest();
    }
}
