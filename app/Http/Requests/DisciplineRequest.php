<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplineRequest extends FormRequest
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
    
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_of_the_discipline' => 'required|string|between:0,255',
            'teacher' => 'required|string|between:0,255',
            'number_hours' => 'required|integer',
            'certification' => 'required|string|between:0,255',
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
            "name_of_the_discipline.required" => "Введите название дисциплины.",
            "teacher.required" => "Ввведите ФИО преподавателя.",
            "number_hours.required" => "Введите количество часов.",
            "certification.required" => "Введите промежуточную аттестацию.",
            "name_of_the_discipline.string" => "Название дисциплины должно быть строковым значением.",
            "teacher.string" => "ФИО преподавателя должно быть строковым значением.",
            "number_hours.integer" => "Количество часов должно иметь числовое значение.",
            "certification.string" => "Промежуточная аттестация должна быть строковым значением.",
            "name_of_the_discipline.between" => "Название дисциплины должно быть не более 255 символов.",
            "teacher.between" => "ФИО преподавателя должно быть не более 255 символов.",
            "certification.between" => "Промежуточная аттестация должна быть не более 255 символов.",
        ];
    }
}