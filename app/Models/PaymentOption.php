<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
