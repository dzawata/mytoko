<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
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
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan password konfirmasi',
            'password_confirmation.required' => 'Password Confirmation wajib diisi',
            'role.required' => 'Role wajib dipilih'
        ];
    }
}
