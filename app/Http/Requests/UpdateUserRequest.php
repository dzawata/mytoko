<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'nama' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->route('id'))
            ],
            'password' => 'nullable|min:8',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama dibutuhkan',
            'email.required' => 'Email dibutuhkan',
            'email.email' => 'Wajib berformat email',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib dipilih'
        ];
    }
}
