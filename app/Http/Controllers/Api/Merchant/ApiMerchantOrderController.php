<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderProductMerchantResource;

use App\Order;

class ApiMerchantOrderController extends Controller
{
    public function index(Request $request)
    {
        return OrderResource::collection(
            auth()->user()->merchant_orders()->groupBy(['orders.id', 'merchant_id'])->filter($request)->paginate('10')
        );
    }

    public function show(Order $order)
    {
        return new OrderProductMerchantResource($order->merchantOrder($order)->first());
    }
}
