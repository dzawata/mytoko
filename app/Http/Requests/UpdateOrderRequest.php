<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'tanggal' => 'required',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi',
            'status.required' => 'Status wajib dipilih'
        ];
    }
}
