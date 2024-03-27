<?php

namespace App\services;

use App\Models\Count;
use App\Models\Transaccione;
use App\services\TransaccionceServicesInterface;

class TransaccioceService implements TransaccionceServicesInterface
{

    public function store(Array $transaccione)
    {
        // TODO: Implement store() method.
        $service = Transaccione::create([
            'sender_id' => "46e9f1dd-dd0c-4e13-bf94-5f0faed1053b",
            'receiver_id' => "7ad8f1c3-5630-44a9-81c6-886ce8fecbac",
            'money' => $transaccione['money']
        ]);
        return $service;
    }

    public function update(Transaccione $transaccione)
    {
        // TODO: Implement update() method.
        $sender = Count::where('id', $transaccione->sender_id)->first();
        $sender->update([
            'money' => $sender->money - $transaccione->money
        ]);

        $receiver = Count::where('id', $transaccione->receiver_id)->first();
        $receiver->update([
            'money' => $receiver->money + $transaccione->money
        ]);
    }
}
