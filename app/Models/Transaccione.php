<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccione extends Model
{
    use HasFactory;
    protected $fillable = [
        'money',
        'sender_id',
        'receiver_id'
    ];
}
