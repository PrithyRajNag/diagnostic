<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_name.required' => 'Service Name is required',
            'quantity.required' => 'Quantity is required',
            'rate.required' => 'Rate is required',
            'status.required' => 'Status is required',
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
            'PUT','POST' =>[
                'service_name' => 'required',
                'quantity' => 'required',
                'rate' => 'required',
                'status' => 'required',
            ],
            default => [],
        };
    }
}
