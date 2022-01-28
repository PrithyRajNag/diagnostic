<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestReportRequest extends FormRequest
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
            'invoice_number.required' => 'Invoice No is required',
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'phone_number.required' => 'Phone No is required',
            'invoice_date.required' => 'Invoice Date is required',
            'delivery_date.required' => 'Delivery Date is required',
            'test_item_id.required' => 'Test Item Name is required',
            'report_name.required' => 'Report Name is required',
            'report.required' => 'Report is required',
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
                'invoice_number' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_number' => 'required',
                'invoice_date' => 'required',
                'delivery_date' => 'required',
                'test_item_id' => 'required',
                'report_name' => 'required',
                'report' => 'required',
                'status' => 'required',
            ],
            default => [],
        };
    }
}
