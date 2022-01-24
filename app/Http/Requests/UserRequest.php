<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'surname' => 'required|string|between:0,255',
            'name' => 'required|string|between:0,255',
            'patronymic' => 'required|string|between:0,255',
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
            "surname.required" => "Введите фамилию",
            "name.required" => "Введите имя",
            "patronymic.required" => "Введите отчество",
            "surname.string" => "Фамилия должна быть строковым значение",
            "name.string" => "Имя должно быть строковым значение",
            "patronymic.string" => "Отчество должно быть строковым значение",
            "surname.between" => "Фамилия не должна быть больше 50 символов",
            "name.between" => "Имя не должно быть больше 50 символов",
            "patronymic.between" => "Отчество не должно быть больше 50 символов",
        ];
    }
}