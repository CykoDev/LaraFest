<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'photo_id'  => 'nullable|image|mimes:jpeg,bmp,png|size:2000',
            'name'      => 'required|string|max:255|unique:users,name,' . $this->id,
            'email'     => 'required|email|max:255|unique:users,email,' . $this->id,
            'new_password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'current_password' => 'required_with:new_password|string',
        ];

        return $rules;
    }
}
