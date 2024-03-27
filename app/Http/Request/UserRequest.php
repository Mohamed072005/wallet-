<?php

namespace App\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserRequest
{
    public function index(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()]
        ]);

        return $validation;
    }

}
