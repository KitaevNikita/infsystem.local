<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\User\UserStoreRequest;

class StudentStoreRequest extends FormRequest
{
    protected $userRequest;

    public function __construct()
    {
        $this->userRequest = new UserStoreRequest();
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
        return array_merge(
            $this->userRequest->rules(), 
            [
                'role' => []
            ], 
            [
                'number' => 'required|string|unique:students,number|between:3,3'
            ]
        );
    }

    public function messages()
    {
        return array_merge($this->userRequest->messages(), [
            "number.required" => "Введите номер студенческого билета",
            "number.string" => "Номер студенческого билета должен быть строчным",
            "number.between" => "Номер студенческого билета должен состоять из трех чисел",
            "number.unique" => "Номер студенческого билета должен быть уникальным"
        ]);
    }
}
