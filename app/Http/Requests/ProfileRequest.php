<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
    public function messages(){
        return [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'phone_number.required' => 'Phone Number is required',
            'gender.required' => 'Gender is required',
            'dob.required' => 'Date of Birth is required',
            'blood_group.required' => 'Blood Group is required',
            'nid.required' => 'NID Number is required',
            'joining_date.required' => 'Joining Date is required',
            'present_address.required' => 'Present Address is required',
            'permanent_address.required' => 'Permanent Address is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();

        return match ($method) {
            'PUT', 'POST' => [
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'phone_number' => 'required|min:11|max:14',
                'gender' => 'required',
                'dob' => 'required',
                'blood_group' => 'required',
                'nid' => 'required|min:10|max:17',
                'joining_date' => 'required',
                'present_address' => 'required',
                'permanent_address' => 'required',
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:5120',

            ],
            default => [],
        };
    }
}
