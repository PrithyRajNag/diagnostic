<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
           'date.required' => "Date field is required",
           'total.required' => "Total Amount field is required",
           'paid_amount.required' => "Paid Amount field is required",
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
                'date' => 'required',
                'total' => 'required',
                'paid_amount' => 'required',
            ],
            default => [],
        };
    }
}
