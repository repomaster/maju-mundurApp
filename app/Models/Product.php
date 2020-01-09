<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Product extends Model
{
    use SoftDeletes;

    public function getImageAttribute($value)
    {
        return url('/') . '/storage/product/' . $value;
    }

    public function getImageNameAttribute()
    {
        return $this->attributes['image'];
    }

    public function getPriceAttribute($value)
    {
        return floatval($value);
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'manage_order', 'product_id', 'order_id')->withPivot(['price', 'qty', 'sub_total']);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'manage_cart', 'product_id', 'cart_id')->withPivot(['qty']);
    }

    public function scopeProductSelect($query)
    {
        DB::statement(DB::raw('set @rownum=0'));
        return $query->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'products.*']);
    }

    public function scopeDataProduct()
    {
        return Product::query()->productSelect()->whereHas('merchant', function ($q) {
            return $q->whereMerchantId(auth()->user()->id);
        });
    }
}
