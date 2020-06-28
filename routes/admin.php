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

Route::resource('users', 'UserController');
Route::resource('shops', 'ShopController');

Route::resource('role', 'RoleController')->except(['show']);
Route::resource('products', 'ProductController');
Route::resource('transactions', 'TransactionController');

//invoice
Route::resource('invoices', 'InvoiceController');
Route::resource('category', 'CategoryController');
Route::get('category/{id}/status', 'CategoryController@status')->name('category.status');

Route::resource('contactus', 'ContactusController')->except(['create', 'store']);
Route::post('contactus/{id}', 'ContactusController@store')->name('contactus.store');

Route::resource('settings', 'SettingController')->only(['index']);

 // get the shop invoices
 Route::get('shop/{id?}/invoices', 'InvoiceController@index')->name('shop_invoices.index')->middleware('auth');

//changes the status of the product
Route::get('products/{id}/status', 'ProductController@status')->name('product.status');

//changes the status of the transaction
Route::get('transactions/{id}/status', 'TransactionController@status')->name('transaction.status');
//changes the paid status of the transaction
Route::get('transactions/{id}/paid', 'TransactionController@paid')->name('transaction.paid');

// Route::get('test',function(){
//     $product = Product::findOrFail(1);

//     dd($product->shops()->attach('2',['quantity'=>12]));
// });

// Route::get('carbon', function () {
//     $product = ProductShop::where('product_id', 1)->first();
//     dd($product);
// });

Route::get('lfm', function () {
    return view('lfm');
});

// Route::get('test', function () {
//     $shop = Shop::findOrFail(1);

//     dd($shop->workers);
// });
