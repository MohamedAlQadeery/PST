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

Route::group(['prefix' => 'site', 'middleware' => 'auth', 'as' => 'site.'], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('products', 'ProductController');
    Route::resource('providers', 'ProviderController');

    //cart functions
    Route::group(['prefix' => 'cart'], function () {
        Route::get('', 'CartController@index')->name('cart.index');
        Route::get('addItem/{id}', 'CartController@addItem')->name('cart.addItem');
        Route::get('{id}', 'CartController@showItems')->name('cart.showItems');
        Route::get('remove/{id}', 'CartController@remove')->name('cart.remove');
    });

    //transaction functions
    Route::group(['prefix' => 'transaction'], function () {
        Route::get('', 'TransactionController@index')->name('transaction.index');
        Route::post('{provider_id}/{type}', 'TransactionController@storeTransaction')->name('transaction.store'); //store transaction
        Route::get('{id}', 'TransactionController@show')->name('transaction.show');
        // Route::get('remove/{id}', 'TransactionController@remove')->name('cart.remove');
    });
});
