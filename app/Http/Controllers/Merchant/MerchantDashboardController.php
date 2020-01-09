<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchantDashboardController extends Controller
{
    public function __invoke()
    {
        return view('merchant.dashboard.index');
    }
}
