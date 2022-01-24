<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'namegroup' => 'required|string|between:0,255',
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
            "namegroup.required" => "Введите группу",
            "namegroup.string" => "Группа должна иметь строковое значение",
            "namegroup.berween" => "Оценка не должна быть больше 255 символов",
        ];
    }
}