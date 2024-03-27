<?php

namespace App\Http\Request;

use App\Models\User;
use Illuminate\Http\Request;

class SendRequest
{
    public function emailExist(Request $request)
    {
        $email = User::where('email', $request->email)->first();

        if (!$email){
            return false;
        }
        return true;
    }

    public function userMoney(Request $request)
    {
        $user = User::join('counts', 'user_id', '=', 'users.id')
            ->where('email', $request->email)->first();

        if($request->money > $user->money){
            return false;
        }
        return  true;
    }

    public function inputValidation(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'money' => ['required', 'min:1']
        ]);

    }
}
