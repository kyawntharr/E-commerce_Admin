<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:categories',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Fill your category name.',
            'name.unique' => 'This name have already.',
            'image.required' => 'Choose category image.',
        ];
    }
}
