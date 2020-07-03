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

//routes for registering the seller

use App\Message;
use App\Transaction;
use App\Notifications\PaidNotification;
use App\User;

Route::get('sregister', 'Back\SellerController@create')->name('seller.create');
Route::post('sregister', 'Back\SellerController@store')->name('seller.store');

//routes for registering the provider
Route::get('pregister', 'Back\ProviderController@create')->name('provider.create');
Route::post('pregister', 'Back\ProviderController@store')->name('provider.store');

Route::get('/', 'Site\HomeController@index');
Route::get('lang/{lang?}', ['as' => 'local.change', 'uses' => 'Back\LangController@change'], );

Route::resource('profile', 'ProfileController')->except(['index']);

Auth::routes(['register' => false]);

Route::post('/mark-as-read', 'NotificationController@markNotification')->name('markNotification')->middleware('auth');

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

Route::get('test', function () {
    // foreach (auth()->user()->notifications as $n) {
    //     echo $n->type;
    //     echo '<br>';
    // }
//
    // $transaction = Transaction::findOrFail(1);
    // $data = ['transaction_id' => $transaction->id, 'provider_name' => $transaction->provider->first_name.' '.$transaction->provider->last_name];
    // $transaction->shop->user->notify(new PaidNotification($data));

    //  /   $user = User::findOrFail(1);

    // foreach ($user->notifications()->get() as $key => $value) {
    //     dd($value->data['provider_name']);
    // }

    $m = Message::findOrFail(10);
    dd($m->parent);
});
