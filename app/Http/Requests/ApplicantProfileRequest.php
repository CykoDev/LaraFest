<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'data[full_name]' => 'Full Name',
            'data[cms_id]' => 'CMS ID',
            'data[batch]' => 'Batch',
            'data[department]' => 'Department',
            'data[gender]' => 'Gender',
            'data[mobile_no]' => 'Mobile no.',
            'data[emegerncy_contact]' => 'Emergency Contact',
            'data[accommodation]' => 'Accommodation',
            'photo_id' => 'User Picture',
            'data[date_of_birth]' => 'Date of Birth',
            'data[cnic]' => 'CNIC',
            'data[cnic_photo_id]' => 'CNIC Picture',
            'data[city]' => 'City',
            'data[blood_group]' => 'Blood Group',
            'data[education_level]' => 'Education Level',
            'data[institution]' => 'Institution',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch(Auth::user()->data['registration_type']){
            case 'nustian':
                return [
                    'data[full_name]' => 'required',
                    'email' => 'required',
                    'data[cms_id]' => 'required',
                    'data[batch]' => 'required',
                    'data[department]' => 'required',
                    'data[gender]' => 'required',
                    'data[mobile_no]' => 'required',
                    'data[emegerncy_contact]' => 'required',
                    'data[accommodation]' => 'required',
                    'photo_id' => 'required',
                ];
                break;
            case 'non_nustian':
                return [
                    'data[full_name]' => 'required',
                    'email' => 'required',
                    'data[date_of_birth]' => 'required',
                    'data[cnic]' => 'required',
                    'data[cnic_photo_id]' => 'required',
                    'data[city]' => 'required',
                    'data[blood_group]' => 'required',
                    'data[education_level]' => 'required',
                    'data[institution]' => 'required',
                    'data[batch]' => 'required',
                    'data[gender]' => 'required',
                    'data[mobile_no]' => 'required',
                    'data[emegerncy_contact]' => 'required',
                    'data[accommodation]' => 'required',
                    'photo_id' => 'required',
                ];
                break;
            case 'professional':
                return [
                    'data[full_name]' => 'required',
                    'email' => 'required',
                    'data[cnic]' => 'required',
                    'data[cnic_photo_id]' => 'required',
                    'data[city]' => 'required',
                    'data[organization]' => 'required',
                    'data[occupation]' => 'required',
                    'photo_id' => 'required',
                    'data[gender]' => 'required',
                    'data[mobile_no]' => 'required',
                    'data[accommodation]' => 'required',
                ];
                break;
        }
    }
}
