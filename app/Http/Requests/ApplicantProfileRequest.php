<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ApplicantProfileRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'name' => 'Username',
            'photo_id' => 'User Picture',

            'data.full_name' => 'Full Name',
            'data.cms_id' => 'CMS ID',
            'data.batch' => 'Batch',
            'data.department' => 'Department',
            'data.gender' => 'Gender',
            'data.mobile_no' => 'Mobile no.',
            'data.emergency_contact' => 'Emergency Contact',
            'data.accommodation' => 'Accommodation',
            'data.date_of_birth' => 'Date of Birth',
            'data.cnic' => 'CNIC',
            'data.cnic_photo_id' => 'CNIC Picture',
            'data.city' => 'City',
            'data.blood_group' => 'Blood Group',
            'data.education_level' => 'Education Level',
            'data.institution' => 'Institution',
            'data.occupation' => 'Occupation',
            'data.organization' => 'Organization',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch (Auth::user()->data['registration_type']) {
            case 'nustian':
                return [
                    'name'      => [
                        'required', 'string', 'max:255',
                        Rule::unique('users')->ignore($this->id),
                    ],
                    'email'     => [
                        'required', 'max:255', 'email:rfc,dns',
                        Rule::unique('users')->ignore($this->id),
                    ],
                    'photo_id' => 'required|image|mimes:jpeg,bmp,png|size:200',

                    'data.full_name' => 'required|string|max:255',
                    'data.cms_id' => 'required|numeric|digits:6',
                    'data.batch' => 'required|alphanum',
                    'data.department' => 'required|string',
                    'data.gender' => 'required',
                    'data.mobile_no' => 'required|numeric',
                    'data.emergency_contact' => 'required|numeric',
                    'data.accommodation' => 'required',
                ];
                break;
            case 'non_nustian':
                return [
                    'name'      => [
                        'required', 'string', 'max:255',
                        Rule::unique('users')->ignore($this->id),
                    ],
                    'email'     => [
                        'required', 'max:255', 'email:rfc,dns',
                        Rule::unique('users')->ignore($this->id),
                    ],
                    'photo_id' => 'required|image|mimes:jpeg,bmp,png|size:200',

                    'data.full_name' => 'required|string|max:255',
                    'data.date_of_birth' => 'required|date',
                    'data.cnic' => 'required|numeric',
                    'data.cnic_photo_id' => 'required|image|mimes:jpeg,bmp,png|size:200',
                    'data.city' => 'required|alpha',
                    'data.blood_group' => 'required',
                    'data.education_level' => 'required|string',
                    'data.institution' => 'required|string',
                    'data.batch' => 'required|alphanum',
                    'data.gender' => 'required',
                    'data.mobile_no' => 'required|numeric',
                    'data.emergency_contact' => 'required|numeric',
                    'data.accommodation' => 'required',
                ];
                break;
            case 'professional':
                return [
                    'name'      => [
                        'required', 'string', 'max:255',
                        Rule::unique('users')->ignore($this->id),
                    ],
                    'email'     => [
                        'required', 'max:255', 'email:rfc,dns',
                        Rule::unique('users')->ignore($this->id),
                    ],
                    'photo_id' => 'required|image|mimes:jpeg,bmp,png|size:200',

                    'data.full_name' => 'required|string|max:255',
                    'data.cnic' => 'required|numeric',
                    'data.cnic_photo_id' => 'required|image|mimes:jpeg,bmp,png|size:200',
                    'data.city' => 'required|alpha',
                    'data.organization' => 'required|string',
                    'data.occupation' => 'required|string',
                    'data.gender' => 'required',
                    'data.mobile_no' => 'required|numeric',
                    'data.emergency_contact' => 'required|numeric',
                    'data.accommodation' => 'required',
                ];
                break;
        }
    }
}
