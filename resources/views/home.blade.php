@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ asset('storage/product/image/'.$product->imageName) }}" class="card-img-top" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text">${{number_format( $product->price, 2) }}</p>
                                        <form action="{{ route('customer.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="products[0][merchant_id]" value="{{ $product->merchant->id }}">
                                            <input type="hidden" name="products[0][product_id]" value="{{ $product->id }}">
                                            <input type="hidden" name="products[0][qty]" value="0">
                                            <button type="submit" class="btn btn-primary">Cart</button>
                                        </form>
                                        <a href="{{ route('customer.checkout.show', $product->id) }}" class="btn btn-primary">Buy</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="well">
                                <h5><b>No Product.</b> </h5>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
