<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function authenticate($credentials, $request)
    {
        if (Auth::attempt($credentials, $request->rememberme)) {

            $request->session()->regenerate();

            // untuk keperluan api, perlu return beberapa data tambahan untuk digunakan oleh FE 
            return (object)[
                'status' => true
            ];
        }

        return (object)[
            'status' => false
        ];
    }

    public function logout($request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return true;
    }
}
