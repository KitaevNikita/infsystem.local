<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;

class UserUpdateRequest extends UserStoreRequest
{
    public function rules($userId = null)
    {
        if($userId === null)
        {
            $userId = $this->route('user');
        }

        return array_merge(parent::rules(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId)
            ],
            'password' => [
                'nullable',
                'string',
                'between:8,25',
            ],
            'role' => []
        ]);  
    }
}