<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'product_name' => 'required|unique:products,product_name',
            'slug' => 'required|unique:products,slug',
            'owner' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Nama produk wajib diisi',
            'product_name.unique' => 'Nama produk sudah terdaftar',
            'slug.required' => 'Slug wajib diisi',
            'slug.unique' => 'Slug sudah terdaftar',
            'owner.required' => 'Owner wajib diisi',
        ];
    }
}
