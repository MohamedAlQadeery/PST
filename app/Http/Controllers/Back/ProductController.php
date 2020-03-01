<?php

namespace App\Http\Controllers\Back;

use App\Product;
use App\Category;
use App\ProductShop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\Product\StoreRequest;

class ProductController extends Controller
{
    public function getProduct($shop_id, $product_id)
    {
        $product = ProductShop::with(['product', 'shop'])->where(['product_id' => $product_id, 'shop_id' => $shop_id])->first();

        return response()->json([
            'product' => $product,
            'success' => 'Got Sample Ajax Request',
        ]);
    }

    public function index()
    {
        $products = Product::all();
        $shop_products = ProductShop::all();

        return view('back.product.index')->with([
            'page_name' => parent::getPluralModelName(),
            'products' => $products,
            'shop_products' => $shop_products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('back.product.create')->with([
            'page_name' => parent::getPluralModelName(),
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except(['image']);

        $product = Product::create($data);

        if ($request->image) {
            $image = parent::uploadImage($request->image);

            Product::where('id', $product->id)->update(['image' => $image]);
        }

        return redirect()->route('products.index')->with('success', __('site.created_successfully'));
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
        $product = Product::findOrFail($id);
        $shop_products = ProductShop::where(['product_id' => $product->id, 'status' => 1])->get();

        return view('back.product.show')->with([
            'page_name' => parent::getPluralModelName(),
            'product' => $product,
            'shop_products' => $shop_products,
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
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('back.product.edit')->with([
            'page_name' => parent::getPluralModelName(),
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->except(['image']);

        if ($request->image) {
            Storage::disk('public_uploads')->delete($product->image);

            $data['image'] = parent::uploadImage($request->image);
        }
        $product->update($data);

        return redirect()->route('products.index')->with('success', __('site.edit_successfully'));
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
        $shop = Product::findOrFail($id);
        if (isset($shop->image)) {
            Storage::disk('public_uploads')->delete($shop->image);
        }
        $shop->delete();

        return redirect()->route('products.index')->with('success', __('site.deleted_successfully'));
    }
}
