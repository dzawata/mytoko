<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMitraRequest extends FormRequest
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
            'mitra' => 'required|unique:mitra,mitra'
        ];
    }

    public function messages()
    {
        return [
            'mitra.required' => 'Mitra wajib diisi',
            'mitra.unique' => 'Mitra yang diinput sudah terdaftar'
        ];
    }
}