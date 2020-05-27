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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//routes for registering the seller
Route::post('sregister', 'Api\SellerController@store')->name('seller.store');

//routes for registering the provider
Route::post('pregister', 'Api\ProviderController@store')->name('provider.store');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', ['as' => 'users.index', 'uses' => 'Api\UserController@index']);
    Route::post('user', ['as' => 'users.store', 'uses' => 'Api\UserController@store']);
    Route::put('user/{id}', ['as' => 'users.update', 'uses' => 'Api\UserController@update']);
    Route::get('user/{id}', ['as' => 'users.show', 'uses' => 'Api\UserController@show']);
    Route::delete('user/{id}', ['as' => 'users.delete', 'uses' => 'Api\UserController@destroy']);

    //shop routes
    Route::get('shop', ['as' => 'shop.show', 'uses' => 'Api\ShopController@show']);
    Route::put('shop', ['as' => 'shop.update', 'uses' => 'Api\ShopController@update']);
    Route::get('shopInvoices', ['as' => 'shop.Invoices', 'uses' => 'Api\ShopController@Invoices']);
    Route::get('shopInvoice', ['as' => 'shop.Invoice', 'uses' => 'Api\ShopController@showInvoice']);

    //products routes
    Route::get('products', ['as' => 'products.index', 'uses' => 'Api\ProductController@index']);
    Route::get('productsInShop', ['as' => 'productsInShop.showProductsInShop', 'uses' => 'Api\ProductController@showProductsInShop']);
    Route::post('products', ['as' => 'products.store', 'uses' => 'Api\ProductController@store']);
    Route::put('products/{id}', ['as' => 'products.update', 'uses' => 'Api\ProductController@update']);
    Route::get('products/{id}', ['as' => 'Products.show', 'uses' => 'Api\ProductController@show']);
    Route::delete('products/{id}', ['as' => 'products.delete', 'uses' => 'Api\ProductController@destroy']);
});
