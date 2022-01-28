<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'start_date.required' => 'Start Date is required',
            'end_date.required' => 'End Date is required',
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

        return match ($method) {
            'PUT', 'POST' => [
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
                'document' =>  'mimes:jpeg,png,doc,docs,pdf',
            ],
            default => [],
        };
    }
}
