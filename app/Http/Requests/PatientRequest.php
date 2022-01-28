<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'first_name.required' => 'first Name is required',
            'last_name.required' => 'Last Name is required',
            'phone_no.required' => 'Phone Number is required',
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
                'phone_no' => 'required',
                'image' => 'mimes:jpeg,jpg,png'
            ],
            default => [],
        };
    }
}
