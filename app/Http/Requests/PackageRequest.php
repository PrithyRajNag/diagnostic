<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'package_name.required' => 'Package Name is required',
            'service_id.required' => 'Service is required',
            'discount.required' => 'Discount is required',
            'status.required' => 'Status is required',
            'amount.required' => 'Amount is required',
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
                'package_name'=> 'required',
                'service_id'=> 'required',
                'discount'=> 'required',
                'status'=> 'required',
                'amount'=> 'required',
            ],
            default => [],
        };
    }
}
