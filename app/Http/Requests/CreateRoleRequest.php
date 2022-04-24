<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            "role" => "required|unique:roles,name|min:3",
            "permissions" => "required"
        ];
    }

    public function messages()
    {
        return [
            "role.required" => "Role wajib diisi",
            "role.unique" => "Role sudah terdaftar",
            "role.min" => "Role min 5 karakter",
            "permissions.required" => "Permission wajib dipilih"
        ];
    }
}
