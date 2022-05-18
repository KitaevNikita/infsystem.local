<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicRequest extends FormRequest
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
            'estimation' => 'required|integer|between:0,2',
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
            "estimation.required" => "Введите оценку",
            "estimation.integer" => "Оценка должна иметь числовое значение",
            "estimation.berween" => "Оценка не должна быть больше 2 символов",
        ];
    }
}