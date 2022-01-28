<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title.required' => 'Title is required',
            'email.required' => 'Email is required',
            'phone_number.required' => 'Phone Number is required',
            'address.required' => 'Address is required',
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
                'title' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'logo' => 'mimes:jpeg,png,jpg,gif,svg|max:5120',
                'favicon' => 'mimes:jpeg,png,jpg,gif,svg|max:5120',
            ],
            default => [],
        };
    }
}
