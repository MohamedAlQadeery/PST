<?php

namespace App\Http\Controllers\Site;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::with(['category', 'provider'])->where('status', '1');

        //gets all the products belongs to providers only
        $products = Product::whereHas('user', function ($q) {
            $q->where('type', 2);
        });

        //products for specific category that belongs to providers only
        if (request()->has('category_id')) {
            $products = $products->where('category_id', request()->input('category_id'));
        }

        $products = $products->where('quantity', '>', 0)->where('status', 1)->orderBy('id', 'DESC')->paginate(12);

        return view('site.product.index')->with([
            'products' => $products,
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
        $product = Product::where(['id' => $id, 'status' => 1])->first();
        $product_date = '';
        if (!is_null($product)) {
            $product_date = new Carbon($product->created_at);
            $product_date = $product_date->toDateTimeString();
        }

        $related_products = Product::with(['category'])->whereHas('user', function ($q) {
            $q->where('type', 2);
        })->
        where('id', '!=', $product->id)->where('category_id', $product->category->id)
        ->where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('site.product.show')->with(['product' => $product, 'product_date' => $product_date, 'related_products' => $related_products]);
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
    }
}
