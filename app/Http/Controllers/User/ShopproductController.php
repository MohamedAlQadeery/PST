<?php

namespace App\Http\Controllers\User;

use App\Product;
use App\ProductShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductShop::where('shop_id', auth()->user()->shop_id)->get();

        return view('users.shopproduct.index')->with([
            'products' => $products,
            'page_name' => 'products',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $product = ProductShop::where(['product_id' => $id, 'shop_id' => auth()->user()->shop_id])->first();
        $product->update($request->all());

        return redirect()->route('user.shopproducts.index')->with('success', __('site.edit_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopproduct = ProductShop::where(['product_id' => $id, 'shop_id' => auth()->user()->shop_id])->delete();
        $product = Product::where('id', $id)->delete();

        return redirect()->route('user.shopproducts.index')->with('success', __('site.deleted_successfully'));
    }
}
