<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BedAssignRequest extends FormRequest
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
            'patient_id.required' => 'Bed Number is required',
            'bed_list_id.required' => 'Bed Type is required',
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
                'patient_id' => 'required',
                'bed_list_id' => 'required',
            ],
            default => [],
        };
    }
}
