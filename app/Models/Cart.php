<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function merchants()
    {
        return $this->belongsToMany(User::class, 'manage_cart', 'cart_id', 'merchant_id')->withPivot(['qty']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'manage_cart', 'cart_id', 'product_id')->withPivot(['qty']);
    }
}
