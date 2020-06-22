<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Message;
use App\Product;
use App\ProductShop;
use App\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $card1 = $card2 = $card3 = $card4 = '';
        $topSolledProducts = '';

        //provider
        if (auth()->user()->type == 2) {
            $card1 = Product::where('user_id', auth()->user()->id)->count();
            $card2 = Transaction::where('provider_id', auth()->user()->id)->count();
            $card3 = Message::where('to_id', auth()->user()->id)->count();
            $card4 = Product::where('sell_count', '>', 0)->where('user_id', auth()->user()->id)->count();

            $topSolledProducts = Product::where('status', 1)->orderBy('sell_count', 'desc')->limit(5)->get();
        } else {
            $card1 = ProductShop::where('shop_id', auth()->user()->shop_id)->count();
            $card2 = Transaction::where('shop_id', auth()->user()->shop_id)->count();
            $card3 = Message::where('to_id', auth()->user()->id)->count();
            $card4 = ProductShop::where('sell_count', '>', 0)->where('shop_id', auth()->user()->shop_id)->count();

            $topSolledProducts = ProductShop::with(['product'])->where('status', 1)->orderBy('sell_count', 'desc')->limit(5)->get();
        }

        return view('users.dashboard')->with(compact(
            'card1', 'card2',
             'card3', 'card4', 'topSolledProducts'));
    }
}
