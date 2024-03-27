<?php

namespace App\Http\Controllers;

use App\Http\Request\CountRequest;
use App\Models\Count;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CountController extends Controller
{
    //
    public function store(Request $request, CountRequest $countRequest)
    {
        $count = $countRequest->index($request);
        if (!$count){
            return response()->json([
                'error' => 'You already created an account.'
            ]);
        }
        try {
            $countRequest->index($request);
        }catch (ValidationException $e){
            return response()->json([
                'error' => $e->validator->errors()->all(),
            ],500);
        }

        $count = Count::create([
            'user_id' => 2,
            'money' => $request->money
        ]);

        return response()->json([
            'message' => 'Your Account Created Successfully',
            'count value' => $count->money
        ],200);
    }

    public function home()
    {
        $counts = Count::join('users', 'user_id', '=', 'users.id')
            ->get(['user_id', 'name', 'email', 'money']);
        return response()->json([
            'users counts' => $counts
        ]);
    }
}
