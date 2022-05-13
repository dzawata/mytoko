<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderItemRequest extends FormRequest
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
            "product" => "required|exists:products,id",
            "keterangan" => "required"
        ];
    }

    public function messages()
    {
        return [
            "product.required" => "Wajib memilih product",
            "product.exists" => "Product yang dim=pilih tidak ditemukan",
            "keterangan.required" => "Keterangan wajib diisi"
        ];
    }
}
