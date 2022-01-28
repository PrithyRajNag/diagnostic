<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestInvoiceRequest extends FormRequest
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
            'first_name.required' => 'First Name is required' ,
            'last_name.required' => 'Last Name is required' ,
            'age.required' => 'Age is required' ,
            'phone_number.required' => 'phone Number is required' ,
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
        return match($method){
            'POST' => [
                'first_name' => 'required',
                'last_name' => 'required',
                'age' => 'required',
                'phone_number' =>  'required',
            ],
            default => [],
        };
    }
}
