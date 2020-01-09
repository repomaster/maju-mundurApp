<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'phone', 'address', 'shop_name', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'merchant_id');
    }

    public function customer_orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function point()
    {
        return $this->hasOne(Point::class, 'customer_id');
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'reward_user', 'customer_id', 'reward_id');
    }

    public function customer_cart()
    {
        return $this->hasOne(Cart::class, 'customer_id');
    }

    public function cart_products()
    {
        return $this->belongsToMany(Product::class, 'manage_cart', 'merchant_id', 'product_id');
    }

    public function order_products()
    {
        return $this->belongsToMany(Product::class, 'manage_order', 'merchant_id', 'product_id')
            ->withPivot(['price', 'qty', 'sub_total']);
    }

    public function merchant_orders()
    {
        return $this->belongsToMany(Order::class, 'manage_order', 'merchant_id', 'order_id');
    }
}
