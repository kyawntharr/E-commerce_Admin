<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'subcat_id' => 'required',
            'tag_id' => 'required',
            'name' => 'required|unique:products',
            'price' => 'required',
            'images' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Choose Category for your product',
            'subcat_id.required' => 'Choose Sub Category for your product',
            'tag_id.required' => 'Choose Tag for your product',
            'name.unique' => 'Already have product with that name',
        ];
    }
}
