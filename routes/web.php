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

Route::get('/', function () {
    return view('welcome');
});
Route::get('lang/{lang?}', ['as' => 'local.change', 'uses' => 'Back\LangController@change'], );

//routes for registering the seller
Route::get('sregister', 'Back\SellerController@create')->name('seller.create');
Route::post('sregister', 'Back\SellerController@store')->name('seller.store');

//routes for registering the provider
Route::get('pregister', 'Back\ProviderController@create')->name('provider.create');
Route::post('pregister', 'Back\ProviderController@store')->name('provider.store');

Route::group(['prefix' => 'back', 'namespace' => 'Back', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');

    Route::resource('users', 'UserController');
    Route::resource('shops', 'ShopController');
    Route::get('shop/{id?}/invoices', 'InvoiceController@index')->name('shop_invoices.index');
    Route::resource('role', 'RoleController')->except(['show']);
    Route::resource('products', 'ProductController');

    //cashier routes

    Route::group(['prefix' => 'cashier'], function () {
        Route::get('', 'CashierController@index')->name('cashier.index');
        Route::get('{shop_id}/product/{product_id}', 'ProductController@getProduct');
        Route::get('{id}', 'CashierController@show');
        Route::post('{id}', 'CashierController@store')->name('cashier.store');
    });

    //invoice
    Route::resource('invoice', 'InvoiceController');
    Route::resource('category', 'CategoryController');
    Route::get('category/{id}/status', 'CategoryController@status')->name('category.status');

    Route::resource('contactus', 'ContactusController')->except(['create', 'store']);
    Route::post('contactus/{id}', 'ContactusController@store')->name('contactus.store');

    Route::resource('settings', 'SettingController')->only(['index']);
});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.', 'middleware' => ['auth', 'isUser']], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');
    Route::resource('messages', 'MessageController');
    Route::get('messagessent', 'MessageController@sentIndex')->name('messages.sentIndex');
    Route::resource('shoprole', 'RoleController');
    Route::resource('products', 'ProductController');
    Route::resource('transaction', 'TransactionController');
});

Route::group(['prefix' => 'site', 'namespace' => 'Site', 'middleware' => 'auth', 'as' => 'site.'], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('products', 'ProductController');
    Route::resource('providers', 'ProviderController');
});

Route::resource('user/profile', 'ProfileController')->except(['index']);

//changes the status of the product
Route::get('products/{id}/status', 'Back\ProductController@status')->name('product.status');

Auth::routes(['register' => false]);

// Route::get('test',function(){
//     $product = Product::findOrFail(1);

//     dd($product->shops()->attach('2',['quantity'=>12]));
// });

Route::get('/home', 'HomeController@index')->name('home');
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
