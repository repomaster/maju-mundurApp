@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <form action="{{ route('merchant.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Name</label>
                                <input name="name" type="text" value="{{ old('name', $product->name) }}" class="form-control" id="inputName" placeholder="Input Name" autocomplete="off">

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStock">Stock</label>
                                <input name="stock" type="text" value="{{ old('stock', $product->stock) }}" class="form-control" id="inputStock" placeholder="Input Stock" autocomplete="off">

                                @error('stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPrice">Price</label>
                                <input name="price" type="text" value="{{ old('price', $product->price) }}" class="form-control" id="inputPrice" placeholder="Input Price" autocomplete="off">

                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputImage">Input Image</label>
                                <input name="image" type="file" class="form-control-file" id="inputImage">

                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <img width="100px" src="{{ asset('storage/product/image/'.$product->imageName) }}" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <textarea name="description" class="form-control" id="inputDescription" rows="3">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
