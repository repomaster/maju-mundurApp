<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ApiProductFormRequest;
use App\Http\Resources\ProductResource;

use App\Product;

class ApiMerchantProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(auth()->user()->products()->paginate(15));
    }

    public function store(ApiProductFormRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $this->storeImage($request);

        auth()->user()->products()->save($product);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ApiProductFormRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            Storage::delete('public/product/image/' . $product->imageName);
            $product->image = $this->storeImage($request);
        }

        $product->save();

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    private function storeImage($request)
    {
        $file = $request->file('image');
        $path = $file->hashName('public/product/image/');
        $image = Image::make($file);

        $image->fit(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::put($path, (string) $image->encode());

        return $file->hashName();
    }
}
