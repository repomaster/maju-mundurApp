<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    public function customers()
    {
        return $this->belongsToMany(User::class, 'reward_user', 'customer_id', 'reward_id');
    }
}
