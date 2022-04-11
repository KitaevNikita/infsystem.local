<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'number' => 'required|string|unique:students,number|between:3,3',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            "number.required" => "Введите номер студенческого билета",
            "number.string" => "Номер студенческого билета должен быть строчным",
            "number.berween" => "Номер студенческого билета должен состоять из трех чисел",
            "number.unique" => "Номер студенческого билета должен быть уникальным",
        ];
    }
}