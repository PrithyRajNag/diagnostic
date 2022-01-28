<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'day.required' => 'Day is required' ,
            'start_time.required' => 'Start Time is required' ,
            'end_time.required' => 'End Time is required' ,
            'per_patient_time.required' => 'Per Patient Time is required',
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
                'doctor_id' => 'required',
                'day' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'per_patient_time' => 'required',
                'status' => 'required',
            ],
            default => [],
        };
    }
}
