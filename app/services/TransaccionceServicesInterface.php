<?php

namespace App\services;

use App\Models\Count;
use App\Models\Transaccione;

interface TransaccionceServicesInterface
{
    public function store(Array $transaccione);
    public function update(Transaccione $transaccione);
}
