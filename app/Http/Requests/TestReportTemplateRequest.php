<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestReportTemplateRequest extends FormRequest
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
            'test_item_id.required' => 'Test Item Name is required',
            'title.required' => 'Title is required',
            'Template.required' => 'Template is required',

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
                'test_item_id' => 'required',
                'title' => 'required',
                'template' => 'required',
            ],
            default => [],
        };
    }
}
