<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'product_name' => [
                'required',
                Rule::unique('products', 'product_name')->ignore($this->route('id'))
            ],
            'slug' => [
                'required',
                Rule::unique('products', 'slug')->ignore($this->route('id'))
            ],
            'owner' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Nama produk wajib diisi',
            'slug.required' => 'Slug wajib diisi',
            'owner.required' => 'Owner wajib diisi',
        ];
    }
}
