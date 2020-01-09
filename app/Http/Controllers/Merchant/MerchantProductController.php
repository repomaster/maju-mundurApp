<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiProductFormRequest;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Product;

use DataTables;

class MerchantProductController extends Controller
{

    public function index()
    {
        return view('merchant.product.index');
    }

    public function ajaxProducts(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::dataProduct();

            return DataTables::of($products)
                ->addColumn('action', function ($product) {
                    return '<a href="' . route('merchant.product.show', $product->id) . '" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a> <a href="' . route('merchant.product.edit', $product->id) . '" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a> <form action="' . route('merchant.product.destroy', $product->id) . '" method="POST">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"><button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        abort('404');
    }

    public function create()
    {
        return view('merchant.product.create');
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

        return redirect()->route('merchant.product.index')->with('success', 'Data successfully created.!');
    }

    public function show(Product $product)
    {
        return view('merchant.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('merchant.product.edit', compact('product'));
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

        return redirect()->route('merchant.product.index')->with('success', 'Data successfully edited.!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('merchant.product.index')->with('success', 'Data successfully deleted.!');
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
