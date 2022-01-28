<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email.required' => 'Email is required',
            'role_id.required' => 'Role is required',
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
        switch($method){
            case 'POST':
                return [
                    'email' => 'required',
                    'role_id' => 'required',
                    'password' => 'max:10'
                ];

            default:
                return[];

        }
    }
}
