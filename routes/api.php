<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/v1/login', 'ApiLoginController@login');
Route::post('/v1/register', 'ApiRegisterController');

Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    Route::post('/logout', 'ApiLoginController@logout');
    Route::get('/users/{user}', 'ApiUserController');

    Route::group(['prefix' => 'merchant', 'middleware' => 'merchant'], function () {
        // PRODUCT
        Route::get('/products', 'ApiMerchantProductController@index');
        Route::get('/products/{product}', 'ApiMerchantProductController@show');
        Route::post('/products', 'ApiMerchantProductController@store');
        Route::put('/products/{product}', 'ApiMerchantProductController@update');
        Route::delete('/products/{product}', 'ApiMerchantProductController@destroy');

        // ORDER
        Route::get('/orders', 'ApiMerchantOrderController@index');
        Route::get('/orders/{order}', 'ApiMerchantOrderController@show');
    });

    Route::group(['middleware' => 'customer'], function () {
        // ORDER
        Route::get('/orders', 'ApiOrderController@index');
        Route::get('/orders/{order}', 'ApiOrderController@show');
        Route::post('/orders', 'ApiOrderController@store');
        Route::put('/orders/{order}', 'ApiOrderController@update');
        Route::delete('/orders/{order}', 'ApiOrderController@destroy');

        // REWARD CUSTOMER
        Route::get('/rewards/customer', 'ApiRewardCustomerController@index');
        Route::post('/rewards/customer', 'ApiRewardCustomerController@store');

        // REWARD
        Route::get('/rewards', 'ApiRewardController@index');
        Route::get('/rewards/{reward}', 'ApiRewardController@show');

        // CART
        Route::get('/carts', 'ApiCartController@index');
        Route::post('/carts', 'ApiCartController@store');
        Route::delete('/carts/{cart}', 'ApiCartController@destroy');

        // CART PRODUCT
        Route::delete('/carts/{cart}/products/{product}', 'ApiCartProductController');
    });
});

Route::group(['prefix' => 'v1', 'middleware' => ['guest:api']], function () {
    Route::get('/products', 'ApiProductController');
});
