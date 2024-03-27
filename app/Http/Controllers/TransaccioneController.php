<?php

namespace App\Http\Controllers;

use App\Http\Request\SendRequest;
use App\Models\Transaccione;
use App\Models\User;
use App\services\TransaccioceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransaccioneController extends Controller
{
    protected $transaccioceService;
    public function __construct(TransaccioceService $transaccioceService)
    {
        $this->transaccioceService = $transaccioceService;
    }

    //
    public function send(SendRequest $send, Request $request)
    {
        try {
            $send->inputValidation($request);
        }catch(ValidationException $e){
            return response()->json([
                'error message' => $e->validator->errors()->all(),
            ], 500);
        }

        $reaponse = $send->emailExist($request);
        if(!$reaponse){
            return response()->json([
                'error' => 'The email does not exist'
            ], 500);
        }

        $money = $send->userMoney($request);
        if (!$money){
            return response()->json([
                'error' => "Insufficient funds!"
            ], 500);
        }

        $parametres = $request->all();
        $return = $this->transaccioceService->store($parametres);

        if ($return){
            $this->transaccioceService->update($return);
        }

        return response()->json([
            'message' => 'Send Money Successfully',
            'result' => $return
        ]);
    }
}
