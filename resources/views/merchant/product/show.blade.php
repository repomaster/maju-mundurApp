@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Product</div>

                <div class="card-body">
                    <form>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Name</label>
                                <input type="text" value="{{ $product->name }}" class="form-control" id="inputName" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStock">Stock</label>
                                <input type="text" value="{{ $product->stock }}" class="form-control" id="inputStock" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPrice">Price</label>
                                <input type="text" value="{{ $product->price }}" class="form-control" id="inputPrice" disabled>
                            </div>
                            <div class="col-md-6">
                                <img width="100px" src="{{ asset('storage/product/image/'.$product->imageName) }}" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescription">Example textarea</label>
                            <textarea class="form-control" id="inputDescription" rows="3" disabled>{{ $product->description }}</textarea>
                        </div>

                        <a href="{{ route('merchant.product.index') }}" type="button" class="btn btn-primary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
