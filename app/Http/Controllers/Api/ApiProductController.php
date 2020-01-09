<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;

use App\Product;

class ApiProductController extends Controller
{
    public function __invoke()
    {
        return ProductResource::collection(Product::query()->paginate(15));
    }
}
