<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\ApiCartFormRequest;
use App\PaymentOption;
use App\Product;
use Illuminate\Http\Request;

class CustomerCartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->customer_cart;
        $paymentOptions = PaymentOption::query()->get();

        return view('customer.cart.index', compact('cart', 'paymentOptions'));
    }

    public function store(ApiCartFormRequest $request)
    {
        if (!$cart = auth()->user()->customer_cart) {
            $cart = new Cart;
        }

        $products = $this->toArray($request);
        $cart->customer()->associate(auth()->user());
        $cart->save();

        $cart->products()->syncWithoutDetaching($products);

        return redirect()->back();
    }

    private function toArray($request)
    {
        $products = [];
        foreach ($request->products as $item) {
            $product = Product::find($item['product_id']);

            $products[$product->id] = [
                'merchant_id' => $item['merchant_id'],
                'qty' => $item['qty'],
            ];
        }

        return $products;
    }
}
