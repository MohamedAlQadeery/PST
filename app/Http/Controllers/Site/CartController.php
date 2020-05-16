<?php

namespace App\Http\Controllers\Site;

use App\User;
use App\Product;
use Darryldecode\Cart\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = \Cart::getContent();
        $providers = collect(); //make collection

        foreach ($cart as $provider) { //filling the collection with the providers in the cart
            $providers[$provider->associatedModel->user_id] = $provider->associatedModel;
        }

        return view('site.cart.index', ['providers' => $providers]);
    }

    public function addItem($id)
    {
        $product = Product::findOrFail($id);
        // \Cart::add($product->id, $product->name, 40,5, ['size'=>'large']);

        // dd($product->user_id);
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => intval($product->quantity), //converting the string to number
            'price' => intval($product->price_to_sell),
            'associatedModel' => $product,
        ]);

        // dd(\Cart::get(12)->associatedModel->user->first_name);
        // dd(\Cart::remove(14));
        return redirect()->route('site.cart.index');

        // return \Cart::getTotal(14);
        // return \Cart::get(14)->name;
    }

    public function showItems($provider_id)
    {
        $provider = User::findOrFail($provider_id);
        $cart = \Cart::getContent();
        $products = collect(); //make a collection

        foreach ($cart as $product) { //fill the collection with the products in the cart with same given provider id
            if ($product->associatedModel->user_id == $provider_id) {
                $products[$product->id] = $product->associatedModel;
            }
        }
        // dd($cart->associatedModel);

        $productsArray = $products->toArray(); //converting the array to object to pass it to the JS code

        return view('site.cart.show', [
            'products' => $products,
            'provider' => $provider,
            'productsArray' => $productsArray,
            ]);
    }

    public function remove($id)
    {
        \Cart::remove($id);

        return redirect()->route('site.cart.index');
    }
}
