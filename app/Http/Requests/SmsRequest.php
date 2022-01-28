<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsRequest extends FormRequest
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
            'sms_to.required' => 'Sms Receiver is required',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
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
                'sms_to' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ],
            default => [],
        };
    }
}
