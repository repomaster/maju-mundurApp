@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="order-table">
                        <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th>Order Code</th>
                                <th>Name</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('custom/js/dataTables/order.js') }}"></script>
<script type="text/javascript"> var url = '{{ url('/customer/orders/ajax') }}'; </script>
@endsection
