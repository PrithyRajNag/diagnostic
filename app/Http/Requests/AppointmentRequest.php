<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'appointment_date.required' => 'Appointment Date is required',
            'schedule_id.required' => 'Slot is required',
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
            'PUT','POST' => [
                'appointment_date'  =>'required',
                'schedule_id' => 'required',
                'status' => 'required',
            ],

            default => [],
        };
    }
}
