<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SummarylistRequest extends FormRequest
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
            'interim' => 'required|string|between:0,255',
            'estimation' => 'required|integer',
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
            "interim.required" => "Введите промежуточную аттестацию",
            "interim.string" => "Промежуточная аттестация должна иметь строковое значение",
            "interim.berween" => "Промежуточная аттестация не должна быть больше 255 символов",
            "estimation.required" => "Введите оценку",
            "estimation.integer" => "Оценка должна иметь числовое значение",
        ];
    }
}