<?php

namespace App\Http\Requests\UserStudent;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\Student\StudentStoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserStudentStoreRequest extends FormRequest
{

    protected $userRequest;
    protected $studentRequest;

    public function __construct()
    {
        $this->userRequest = new UserStoreRequest();
        $this->studentRequest = new StudentStoreRequest();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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

    public function messages()
    {
        $messages = array_merge($this->userRequest->messages(), $this->studentRequest->messages());
        return $messages;
    }
}
