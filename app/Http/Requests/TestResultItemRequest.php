<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestResultItemRequest extends FormRequest
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
            'title.required' => 'Title is required',
            'reference.required' => 'Response is required',
            'result_category_id.required' => 'Test Result Category is required',
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
                'title' => 'required',
                'reference' => 'required',
                'result_category_id' => 'required',
            ],
            default => [],
        };
    }
}
