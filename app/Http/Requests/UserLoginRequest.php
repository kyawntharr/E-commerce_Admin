<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|min:5|max:25',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Fill your email',
            'password.required' => 'Fill your password',
            'password.min' => 'Password အနည္းဆုံး ၆လုံးထည့္ရမည္'
        ];
    }
}
