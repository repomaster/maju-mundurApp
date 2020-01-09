<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => false, 'reset' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'merchant', 'middleware' => 'merchant'], function () {
        Route::get('/', function () {
            return redirect()->route('merchant.dashboard.index');
        });

        // DASHBOARD
        Route::get('/dashboard', 'MerchantDashboardController')->name('merchant.dashboard.index');

        // PPRODUCT
        Route::prefix('products')->name('merchant.product.')->group(function () {
            Route::get('/', 'MerchantProductController@index')->name('index');
            Route::get('/ajax', 'MerchantProductController@ajaxProducts');
            Route::get('/create', 'MerchantProductController@create')->name('create');
            Route::post('/', 'MerchantProductController@store')->name('store');
            Route::get('/{product}', 'MerchantProductController@show')->name('show');
            Route::get('/{product}/edit', 'MerchantProductController@edit')->name('edit');
            Route::put('/{product}', 'MerchantProductController@update')->name('update');
            Route::delete('/{product}', 'MerchantProductController@destroy')->name('destroy');
        });

        Route::prefix('orders')->name('merchant.order.')->group(function () {
            Route::get('/', 'MerchantOrderController@index')->name('index');
            Route::get('/ajax', 'MerchantOrderController@ajaxOrders');
            Route::get('/{order}', 'MerchantOrderController@show')->name('show');
        });
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'customer'], function () {
        Route::get('/', function () {
            return redirect()->route('customer.dashboard.index');
        });

        // DASHBOARD
        Route::get('/dashboard', 'CustomerDashboardController')->name('customer.dashboard.index');

        // Cart
        Route::prefix('carts')->name('customer.cart.')->group(function () {
            Route::get('/', 'CustomerCartController@index')->name('index');
            Route::post('/', 'CustomerCartController@store')->name('store');
        });

        // Order
        Route::prefix('orders')->name('customer.order.')->group(function () {
            Route::get('/', 'CustomerOrderController@index')->name('index');
            Route::get('/ajax', 'CustomerOrderController@ajaxOrders');
            Route::get('/{order}', 'CustomerOrderController@show')->name('show');
        });

        // Checkout
        Route::prefix('checkout')->name('customer.checkout.')->group(function () {
            Route::get('/{product}', 'CustomerCheckoutController@show')->name('show');
            Route::post('/', 'CustomerCheckoutController@store')->name('store');
        });

        // Reward
        Route::prefix('rewards')->name('customer.reward.')->group(function () {
            Route::get('/', 'CustomerRewardController@index')->name('index');
            Route::post('/{reward}', 'CustomerRewardController@store')->name('store');
        });
    });
});
