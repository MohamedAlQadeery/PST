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

use App\Product;

Route::get('/', function () {
    return view('welcome');
});
Route::get('lang/{lang?}',['as'=>'local.change', 'uses'=>'Back\LangController@change'],);

Route::get('back','Back\DashboardController@index')->name('dashboard');

//routes for registering the seller
Route::get('sregister','Back\SellerController@create')->name('seller.create');
Route::post('sregister','Back\SellerController@store')->name('seller.store');

//routes for registering the provider
Route::get('pregister','Back\ProviderController@create')->name('provider.create');
Route::post('pregister','Back\ProviderController@store')->name('provider.store');


Route::group(['prefix'=>'back','namespace'=>'Back'],function(){

   Route::resource('users', 'UserController');

    Route::resource('role','RoleController')->except(['show']);


});

Auth::routes(['register'=>false]);

// Route::get('test',function(){
//     $product = Product::findOrFail(1);

//     dd($product->shops()->attach('2',['quantity'=>12]));
// });




Route::get('/home', 'HomeController@index')->name('home');




