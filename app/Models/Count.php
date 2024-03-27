<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Count extends Model
{
    use HasFactory, Uuids;
    protected $fillable = [
        'user_id',
        'money'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function sender(){
        return $this->hasMany(Transaccione::class,'sender_id','id');
    }

    public function receiver(){
        return $this->hasMany(Transaccione::class,'receiver_id','id');
    }
}
