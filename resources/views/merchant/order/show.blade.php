@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Order</div>

                <div class="card-body">
                    <div class="well">
                        <h5><b>Order Code : {{ $dataOrder->order_code }}</b></h5>
                        <h5><b>Name : {{ $dataOrder->customer->name }}</b> </h5>
                    </div>

                    <table class="table table-bordered table-striped table-hover" id="product-table">
                        <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; $total = 0; @endphp
                            @foreach ($dataOrder->merchants->first()->order_products as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->qty }}</td>
                                    <td>{{ floatval($product->pivot->price) }}</td>
                                    <td>{{ floatval($product->pivot->sub_total) }}</td>
                                    @php $total += $product->pivot->sub_total; @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Total</td>
                                <td>{{ $total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
