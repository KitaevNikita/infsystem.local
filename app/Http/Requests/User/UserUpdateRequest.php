<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Nullable;

class UserUpdateRequest extends UserStoreRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            
            'password' => [
                'nullable',
                'string',
                'between:8,25',
            ]
        ]);
    }
}