<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Order extends Model
{
    use SoftDeletes;

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function merchants()
    {
        return $this->belongsToMany(User::class, 'manage_order', 'order_id', 'merchant_id')
            ->withPivot(['price', 'qty', 'sub_total']);
    }

    public function payment_option()
    {
        return $this->belongsTo(PaymentOption::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'manage_order', 'order_id', 'product_id')
            ->withPivot(['price', 'qty', 'sub_total']);
    }

    public function scopeFilter($query, $request)
    {
        if ($request->query('history') && $request->query('history') == "true") {
            $query->whereIn('status', ['done', 'cancel']);
        } else {
            if ($status = $request->query('status')) {
                $query->whereStatus($status);
            }
            if ($payment_status = $request->query('payment_status')) {
                $query->wherePaymentStatus($payment_status);
            }
        }

        if ($orderBy = $request->query('order_by')) {
            $sort = ($sort = $request->query('sort')) ? $sort : 'asc';
            $query->orderBy($orderBy, $sort);
        }

        return $query;
    }

    public function scopeMerchantOrder($query, $order)
    {
        return $this->with(['merchants' => function ($query) use ($order) {
            $query->where('manage_order.merchant_id', auth()->user()->id);
            $query->with(['order_products' => function ($query) use ($order) {
                $query->where('manage_order.order_id', $order->id);
            }]);
        }]);
    }

    public function scopeOrderSelect($query)
    {
        DB::statement(DB::raw('set @rownum=0'));
        return $query->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'orders.*']);
    }

    public function scopeDataOrder()
    {
        return Order::query()->orderSelect()->whereHas('merchants', function ($q) {
            $q->whereMerchantId(auth()->user()->id);
        })->with(['customer']);
    }

    public function scopeDataOrderCustomer()
    {
        return Order::query()->orderSelect()->whereHas('customer', function ($q) {
            $q->whereCustomerId(auth()->user()->id);
        })->with(['customer']);
    }
}
