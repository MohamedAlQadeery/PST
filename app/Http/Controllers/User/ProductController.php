<?php

namespace App\Http\Controllers\User;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\Product\StoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->user()->id)->get();

        return view('users.product.index')->with([
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
        $categories = Category::all();

        return view('users.product.create')->with([
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
        $data['user_id'] = auth()->user()->id;
        if ($request->image) {
            $data['image'] = parent::uploadImage($request->image);
        }

        $product = Product::create($data);

        return redirect()->route('user.products.index')->with('success', __('site.created_successfully'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('users.product.show')->with([
            'page_name' => 'products',
            'product' => $product,
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

        return view('users.product.edit')->with([
            'page_name' => 'products',
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
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->except(['image']);

        if ($request->image) {
            Storage::disk('public_uploads')->delete($product->image);

            $data['image'] = parent::uploadImage($request->image);
        }
        $product->update($data);

        return redirect()->route('user.products.index')->with('success', __('site.edit_successfully'));
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
        $product = Product::findOrFail($id);
        if (isset($product->image)) {
            Storage::disk('public_uploads')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('user.products.index')->with('success', __('site.deleted_successfully'));
    }
}
