<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestItemRequest extends FormRequest
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
            'category_id.required' => 'Test Category is required',
            'test_name.required' => 'Test Name is required',
            'price.required' => 'Price is required',
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
                'category_id' => 'required',
                'test_name' => 'required',
                'price' => 'required',
                'status' => 'required',
            ],
            default => [],
        };

    }
}
