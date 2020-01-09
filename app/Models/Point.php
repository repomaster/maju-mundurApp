<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['points'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
