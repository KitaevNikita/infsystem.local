<?php

namespace App\Http\Requests;

use App\Rules\MarkValidity;
use Illuminate\Foundation\Http\FormRequest;

class SummaryListRequest extends FormRequest
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
            'interim' => ['nullable', 'string', 'size:1', new MarkValidity(false)],
            'estimation' => ['nullable', 'string', 'size:1', new MarkValidity(false)],
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        $size = 'Вы ввели неверные данные';
        return [
            "interim.size" => $size,
            "estimation.size" => $size,
        ];
    }
}