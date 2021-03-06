@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cart</div>

                <div class="card-body">
                    @if ($cart)
                        <form action="{{ route('customer.checkout.store') }}" method="POST">
                            @csrf
                            @foreach ($cart->products as $key => $product)
                                <div class="well">
                                    <img width="100px" src="{{ asset('storage/product/image/'.$product->imageName) }}" alt="">
                                    <h5><b>Name : {{ $product->name }}</b></h5>
                                    <h5><b>Price : ${{ number_format($product->price, 2) }}</b> </h5>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputQty">Qty</label>
                                        <input type="hidden" name="{{ 'products['.$key.'][merchant_id]' }}" value="{{ $product->merchant->id }}">
                                        <input type="hidden" name="{{ 'products['.$key.'][product_id]' }}" value="{{ $product->id }}">
                                        <input name="{{ 'products['.$key.'][qty]' }}" type="text" value="{{ old('products['.$key.'][qty]') }}" class="form-control" id="inputQty" placeholder="Input Qty" autocomplete="off">

                                        @error('product['.$key.'][qty]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPaymentOption">Payment Option</label>
                                    <select name="payment_option_id" class="form-control" id="inputPaymentOption">
                                        @foreach ($paymentOptions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product[0][qty]')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputShippingAddress">Shipping Address</label>
                                <textarea name="shipping_address" class="form-control" id="inputShippingAddress" rows="3">{{ old('shipping_address') }}</textarea>

                                @error('shipping_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <div class="well">
                            <h5><b>Empty Cart.</b> </h5>
                            <a href="{{ route('home') }}" class="btn btn-primary">Shopping Now!</a>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
