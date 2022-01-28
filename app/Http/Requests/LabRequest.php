<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
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
            'lab_name.required' => 'Lab Name is required',
            'room.required' => 'Room Number is required' ,
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
                'lab_name' => 'required',
                'room_number' => 'required'
            ],
            default => [],
        };


    }
}
