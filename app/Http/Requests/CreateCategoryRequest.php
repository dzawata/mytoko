<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'category' => 'required|unique:categories,category'
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Category wajib diisi',
            'category.unique' => 'Category yang diinput sudah ada',
        ];
    }
}
