<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;

class ApiCartProductController extends Controller
{
    public function __invoke(Cart $cart, Product $product)
    {
        $cart->products()->detach($product);

        return response()->json(null, 204);
    }
}
