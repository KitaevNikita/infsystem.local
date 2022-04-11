<?php

namespace App\Http\Requests\UserStudent;

use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\StudentRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStudentUpdateRequest extends UserStudentStoreRequest
{
    public function __construct()
    {
        $this->userStoreRequest = new UserUpdateRequest();
        $this->studentRequest = new StudentRequest();
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            'number' => [
                'required',
                'string',
                Rule::unique('students')->ignore($this->route('student'))
            ]
        ]);  
    }
}
