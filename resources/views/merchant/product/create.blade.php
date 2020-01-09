@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Product</div>

                <div class="card-body">
                    <form action="{{ route('merchant.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Name</label>
                                <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="inputName" placeholder="Input Name" autocomplete="off">

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStock">Stock</label>
                                <input name="stock" type="text" value="{{ old('stock') }}" class="form-control" id="inputStock" placeholder="Input Stock" autocomplete="off">

                                @error('stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPrice">Price</label>
                                <input name="price" type="text" value="{{ old('price') }}" class="form-control" id="inputPrice" placeholder="Input Price" autocomplete="off">

                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputImage">Input Image</label>
                                <input name="image" type="file" class="form-control-file" id="inputImage">

                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescription">Example textarea</label>
                            <textarea name="description" class="form-control" id="inputDescription" rows="3">{{ old('description') }}</textarea>

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
