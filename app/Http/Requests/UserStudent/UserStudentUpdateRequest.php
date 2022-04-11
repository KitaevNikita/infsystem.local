<?php

namespace App\Http\Requests\UserStudent;

use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class UserStudentUpdateRequest extends UserStudentStoreRequest
{
    public function __construct()
    {
        $this->userRequest = new UserUpdateRequest();
        $this->studentRequest = new StudentUpdateRequest();

        Log::info($this->rules());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = array_merge($this->userRequest->rules(), ['role' => []]);
        $rules = array_merge($rules, $this->studentRequest->rules());
        return $rules;
    }
}
