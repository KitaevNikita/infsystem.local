<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecializationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'namespec' => 'required|string|between:0,255'
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
            "namespec.required" => "Введите название специальности",
            "namespec.string" => "Поле специальность должно иметь строковое значение",
            "namespec.berween" => "Название специальности должно быть не более 255 символов",
        ];
    }
}