<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorPercentageRequest extends FormRequest
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
            'doctor_id.required' => 'Doctor Name is required',
            'percentage.required' => 'Percentage is required',
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
                'doctor_id' => 'required',
                'percentage' => 'required',
            ],
            default => [],
        };
    }
}
