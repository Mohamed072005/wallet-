<?php

namespace App\Http\Controllers;

use App\Http\Request\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function register(Request $request, UserRequest $userRequest)
    {
        try {
            $userRequest->index($request);
        }catch (ValidationException $e){

            return response()->json([
                'error' => $e->validator->errors()->all(),
            ],500);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'response' => 'user created successfully',
            'user' => $user
        ]);
    }


    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

            if (Auth::attempt($user)){
                $info = Auth::user();
                $token = $info->createToken('API TOKEN')->plainTextToken;
                return response()->json(['message' => 'Welcome from Home page', 'token' => $token]);
            }else{
                return response()->json([
                    'error' => 'Invalid email or password'
                ], 500);
            }
    }
}
