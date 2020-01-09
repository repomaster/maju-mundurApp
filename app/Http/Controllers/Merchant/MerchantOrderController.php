<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use DataTables;

class MerchantOrderController extends Controller
{
    public function index()
    {
        return view('merchant.order.index');
    }

    public function ajaxOrders(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::dataOrder();

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    return '<a href="' . route('merchant.order.show', $order->id) . '" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        abort('404');
    }

    public function show(Order $order)
    {
        $dataOrder = $order->merchantOrder($order)->first();

        return view('merchant.order.show', compact('dataOrder'));
    }
}
