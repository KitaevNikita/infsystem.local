<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'date' => 'required',
            'topic' => 'required|string|between:0,255',
            'type' => 'required',
            'number_of_hours' => 'required|integer|between:1,2',
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
            "date.required" => "Введите дату проведения урока",
            "topic.required" => "Введите тему урока",
            "topic.string" => "Тема урока должна быть строковым значением",
            "topic.between" => "Количество символов не должно быть больше 255",
            "type.required" => "Выберите тип урока",
            "number_of_hours.required" => "Введите количество часов",
            "number_of_hours.integer" => "Должно быть челое число",
            "number_of_hours.between" => "Введите значеие один или два",
        ];
    }
}