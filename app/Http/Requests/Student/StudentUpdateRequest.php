<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class StudentUpdateRequest extends StudentStoreRequest
{
    public function __construct()
    {
        $this->userRequest = new UserUpdateRequest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->route('student');
        $studentId = User::find($userId)->student->id;

        return array_merge(
            $this->userRequest->rules($userId),
            [
                'number' => [
                    'required',
                    'string',
                    'between:3,3',
                    Rule::unique('students')->ignore($studentId)
                ]
            ]
        );
    }
}
