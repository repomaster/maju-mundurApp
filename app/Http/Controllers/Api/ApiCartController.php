<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiCartFormRequest;

use App\Http\Resources\CartResource;

use App\Cart;
use App\Product;

class ApiCartController extends Controller
{
    public function index()
    {
        return new CartResource(auth()->user()->customer_cart);
    }

    public function store(ApiCartFormRequest $request)
    {
        if (!$cart = auth()->user()->customer_cart) {
            $cart = new Cart;
        }

        $products = $this->toArray($request);
        $cart->customer()->associate(auth()->user());
        $cart->save();

        $cart->products()->sync($products);

        return new CartResource($cart);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json(null, 204);
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
