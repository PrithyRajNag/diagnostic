<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BedListRequest extends FormRequest
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
            'bed_number.required' => 'Bed Number is required',
            'bed_type_id.required' => 'Bed Type is required',
            'floor_no.required' => 'Floor is required',
            'price.required' => 'Price is required',
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
                'bed_number' => 'required',
                'bed_type_id' => 'required',
                'floor_no' => 'required',
                'price' => 'required',
                'status' => 'required',
            ],
            default => [],
        };
    }
}
