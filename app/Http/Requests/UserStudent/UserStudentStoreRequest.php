<?php

namespace App\Http\Requests\UserStudent;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\StudentRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserStudentStoreRequest extends FormRequest
{

    protected $userStoreRequest;
    protected $studentRequest;

    public function __construct()
    {
        $this->userStoreRequest = new UserStoreRequest();
        $this->studentRequest = new StudentRequest();
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
        $rules = $this->userStoreRequest->rules();
        $rules = array_merge($rules, $this->studentRequest->rules());
        return $rules;
    }

    public function messages()
    {
        $messages = $this->userStoreRequest->messages();
        $messages = array_merge($messages, $this->studentRequest->messages());
        return $messages;
    }
}
