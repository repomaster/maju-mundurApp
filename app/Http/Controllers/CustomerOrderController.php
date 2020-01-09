<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use DataTables;

class CustomerOrderController extends Controller
{
    public function index()
    {
        return view('customer.order.index');
    }

    public function ajaxOrders(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::dataOrderCustomer();

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    return '<a href="' . route('customer.order.show', $order->id) . '" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        abort('404');
    }

    public function show(Order $order)
    {
        return view('customer.order.show', compact('order'));
    }
}
