<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiOrderFormRequest;
use App\Order;
use App\PaymentOption;
use App\Product;
use Illuminate\Http\Request;

class CustomerCheckoutController extends Controller
{
    public function show(Product $product)
    {
        $paymentOptions = PaymentOption::query()->get();

        return view('customer.checkout.show', compact('product', 'paymentOptions'));
    }

    public function store(ApiOrderFormRequest $request)
    {
        $lastId = ($lastOrder = Order::latest()->first()) ? $lastOrder->id : '0';

        $order = new Order;
        $products = $this->toArray($request);
        $paymentOption = PaymentOption::find($request->payment_option_id);

        $order->order_code = '#' . str_pad($lastId + 1, 8, "0", STR_PAD_LEFT);
        $order->fee = $paymentOption->fee;
        $order->sub_total = $products['order_sub_total'];
        $order->total = $products['order_sub_total'] + $paymentOption->fee;
        $order->shipping_address = $request->shipping_address;

        $order->payment_option()->associate($paymentOption);
        $order->customer()->associate(auth()->user());
        $order->save();

        $order->products()->attach($products['products']);

        $this->calculatePoint();

        if ($cart = auth()->user()->customer_cart) {
            $cart->delete();
        }

        return redirect()->route('customer.dashboard.index');
    }

    private function toArray($request)
    {
        $products = [];
        $order_sub_total = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['product_id']);
            $sub_total = $item['qty'] * $product->price;
            $order_sub_total += $sub_total;

            $products[$product->id] = [
                'merchant_id' => $item['merchant_id'],
                'price' => $product->price,
                'qty' => $item['qty'],
                'sub_total' => $sub_total
            ];
        }

        return [
            'products' => $products,
            'order_sub_total' => $order_sub_total
        ];
    }

    private function calculatePoint()
    {
        $user = auth()->user();
        if ($user->point) {
            return $user->point()->update(['points' => $user->point->points + 1]);
        }

        return $user->point()->create(['points' => 1]);
    }
}
