<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmbulanceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function messages(){
        return [
            'vehicle_number.required' => 'Vehicle Number is required',
            'vehicle_model.required' => 'Vehicle Model is required',
            'driver_name.required' => 'Driver Name is required',
            'driver_phone_number.required' => 'Driver Phone Number is required',
            'driver_license.required' => 'Driver License is required',
            'present_address.required' => 'Present Address is required',
            'permanent_address.required' => 'Permanent Address is required',
            'status.required' => 'Status is required',

        ];
    }

    public function rules()
    {
        $method = $this->method();

        return match ($method) {
            'PUT', 'POST' => [
                'vehicle_number' => 'required',
                'vehicle_model' => 'required',
                'driver_name'  =>'required',
                'driver_phone_number' => 'required',
                'driver_license' => 'required',
                'present_address'=> 'required',
                'permanent_address' => 'required',
                'status' => 'required',
            ],
            default => [],
        };
    }
}
