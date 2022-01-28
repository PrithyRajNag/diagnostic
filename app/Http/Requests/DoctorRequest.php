<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'email.required' => 'Email is required',
            'designation.required' => 'Designation is required',
            'department_id.required' => 'Department is required',
            'phone_number.required' => 'Phone Number is required',
            'dob.required' => 'Date of Birth is required',
            'gender.required' => 'Gender is required',
            'blood_group.required' => 'Blood Group is required',
            'present_address.required' => 'Present Address is required',
            'permanent_address.required' => 'Permanent Address is required',
            'user_type.required' => 'User Type is required',
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
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'designation' => 'required',
                'department_id' => 'required',
                'phone_number' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'blood_group' => 'required',
                'present_address' => 'required',
                'permanent_address' => 'required',
                'image' => 'mimes:jpeg,jpg,png',
                'user_type' => 'required',
            ],
            default => [],
        };
    }
}
