<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'surname' => 'required|string|between:2,50',
            'name' => 'required|string|between:2,50',
            'patronymic' => 'required|string|between:2,50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|between:8,25',
            'role' => 'required',
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
            "email.required" => "Введите E-mail",
            "email.unique" => "Пользователь с таким E-mail уже существует",
            "email.email" => "Введите валидный E-mail",
            "password.required" => "Введите пароль",
            "password.string" => "Пароль должен быть строковым значение",
            "password.between" => "Пароль не должен быть больше 25 символов",
            "role.required" => "Введите роль",
        ];
    }
}