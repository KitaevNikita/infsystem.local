<?php

namespace App\Http\Requests;

use App\Rules\MarkValidity;
use Illuminate\Foundation\Http\FormRequest;

class MarkRequest extends FormRequest
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
            'mark1' => ['nullable', 'string', 'size:1', new MarkValidity(true)],
            'mark2' => ['nullable', 'string', 'size:1', new MarkValidity(true)],
        ];
    }
    
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        $size = "Вы ввели некоректные данные.";
        return [
            "mark1.size" => $size,
            "mark2.size" => $size,
        ];
    }
}
