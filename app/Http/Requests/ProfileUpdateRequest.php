<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
        $rules =  [
            'photo_id'  => 'nullable|image|mimes:jpeg,bmp,png|max:2000',
            'name'      => [
                'required', 'string', 'max:255',
                Rule::unique('users')->ignore($this->id),
            ],
            'email'     => [
                'required', 'max:255', 'email:rfc,dns',
                Rule::unique('users')->ignore($this->id),
            ],
            // 'new_password' => 'nullable|required_with:password_confirmation|string|confirmed',
            // 'current_password' => 'required_with:new_password|string',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Username',
            'photo_id' => 'User Picture',
        ];
    }
}
