<?php

namespace App\Http\Controllers\Back;

use App\ContactUs;
use App\Product;
use App\ProductShop;
use App\Transaction;
use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all')->only('index');
    }

    public function index()
    {
        $card1 = $card2 = $card3 = $card4 = '';
        $topSolledProducts = '';

        $card1 = User::where('id', '!=', auth()->user()->id)->count();
        $card2 = Product::count();
        $card3 = ProductShop::count();
        $card4 = Transaction::count();

        //providers
        $providertopSolledProducts = Product::where('status', 1)->orderBy('sell_count', 'desc')->limit(5)->get();

        $sellerTopSolledProducts = ProductShop::with(['product'])->where('status', 1)->orderBy('sell_count', 'desc')->limit(5)->get();

        $contactusMessages = ContactUs::where('parent_id', null)->orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard')->with(compact(
            'card1', 'card2',
             'card3', 'card4', 'providertopSolledProducts', 'sellerTopSolledProducts', 'contactusMessages'));
    }
}
