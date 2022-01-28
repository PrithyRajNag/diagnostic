<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'address.required' => 'Address is required',
            'organization_type.required' => 'Organization Type is required'
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
                'address' => 'required',
                'organization_type' => 'required',
            ],
            default => [],
        };
    }
}
