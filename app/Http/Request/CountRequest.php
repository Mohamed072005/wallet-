<?php

namespace App\Http\Request;

use App\Models\Count;
use Illuminate\Http\Request;

class CountRequest
{
    public function index(Request $request)
    {
        $user_id = 2;
        $user = Count::where('user_id', $user_id)->first();
        if ($user){
            return false;
        }

        $count = $request->validate([
            'money' => ['required', 'gt:0']
        ]);

        return $count;
    }
}
