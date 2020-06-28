<?php

namespace App\Http\Controllers\Site;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
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
        $product = Product::with(['reviews' => function ($q) {
            $q->orderBy('id', 'desc');
        }])->where(['id' => $id, 'status' => 1])->first();
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

        // getting the all rates from this provider
        $provider_rate = Review::where('product_id', $product->id)->get();

        // array for the stars
        $starsArray = array(
              '1' => 0,
              '2' => 0,
              '3' => 0,
              '4' => 0,
              '5' => 0,
          );

        // getting the satrs and store it in the array
        foreach ($provider_rate as $rate) {
            switch ($rate->stars) {
                  case 1:
                      $starsArray['1'] = +1;
                      // no break
                  case 2:
                      $starsArray['2'] = +1;
                      // no break
                  case 3:
                      $starsArray['3'] = +1;
                      // no break
                  case 4:
                      $starsArray['4'] = +1;
                      // no break
                  case 5:
                      $starsArray['5'] = +1;
              }
        }

        // calucalate the weighted average for the stars
        $rate_sum = ($starsArray['1'] + $starsArray['2'] + $starsArray['3'] + $starsArray['4'] + $starsArray['5']);
        $rate = 0;
        if ($rate_sum) {
            $rate = (1 * $starsArray['1'] + 2 * $starsArray['2'] + 3 * $starsArray['3'] + 4 * $starsArray['4'] + 5 * $starsArray['5']) / $rate_sum;
            $rate = ((int) round($rate) / 5) * 10;
        }

        return view('site.product.show')->with([
        'product' => $product,
        'product_date' => $product_date,
        'related_products' => $related_products,
        'rate' => $rate,
        ]);
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
