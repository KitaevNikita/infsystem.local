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
            'namegroup' => 'required|string|between:2,10',
            'specialization_id' => 'required',
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
            "namegroup.required" => "Введите группу.",
            "namegroup.string" => "Группа должна иметь строковое значение.",
            "namegroup.between" => "Название группы должно быть в диапазоне от :min до :max.",
            "specialization_id.required" => "Выберите специализацию.",
        ];
    }
}