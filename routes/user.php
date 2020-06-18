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

Route::get('', 'DashboardController@index')->name('dashboard');
Route::resource('messages', 'MessageController');
Route::get('messagessent', 'MessageController@sentIndex')->name('messages.sentIndex');
Route::resource('shoprole', 'RoleController');
Route::resource('products', 'ProductController');
Route::resource('contactus', 'ContactusController');
Route::resource('transaction', 'TransactionController');
Route::resource('subworkers', 'SubworkerController');
Route::resource('shopproducts', 'ShopproductController');
Route::resource('invoices', 'InvoiceController');

//cashier routes
Route::group(['prefix' => 'cashier'], function () {
    Route::get('', 'CashierController@index')->name('cashier.index');
    Route::get('{shop_id}/product/{product_id}', 'ProductController@getProduct');
    Route::get('{id}', 'CashierController@show')->name('cashier.show');
    Route::post('{id}', 'CashierController@store')->name('cashier.store');
});

Route::resource('transaction', 'TransactionController');

//changes the status of the product
Route::get('products/{id}/status', 'ProductController@status')->name('product.status');
