<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        $method = $this->method();

        return match ($method) {
            'PUT', 'POST' => [
                'title' => 'required',
            ],
            default => [],
        };
    }
}
