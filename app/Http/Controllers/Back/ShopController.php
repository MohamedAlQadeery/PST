<?php

namespace App\Http\Controllers\Back;

use App\Shop;
use App\ProductShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\Shop\StoreRequest;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Shop $shop)
    {
        $this->middleware('permission:update-shop|all')->only('edit');
        $this->middleware('permission:delete-shop|all')->only('destroy');
        parent::__construct($shop);
    }

    public function index()
    {
        $shops = Shop::all();

        return view('back.shop.index')->with([
            'page_name' => parent::getPluralModelName(),
            'shops' => $shops,
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
        $shop = Shop::findOrFail($id);
        $shop_products = ProductShop::where(['shop_id' => $shop->id, 'status' => 1])->get();

        return view('back.shop.show')->with([
            'page_name' => parent::getPluralModelName(),
            'shop' => $shop,
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
        $shop = Shop::findOrFail($id);

        return view('back.shop.edit')->with([
            'page_name' => parent::getPluralModelName(),
            'shop' => $shop,
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
        $shop = Shop::findOrFail($id);
        $data = $request->except(['image']);

        if ($request->image) {
            Storage::disk('public_uploads')->delete($shop->image);

            $data['image'] = parent::uploadImage($request->image);
        }
        $shop->update($data);

        return redirect()->route('admin.shops.index')->with('success', __('site.edit_successfully'));
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
        $shop = Shop::findOrFail($id);
        if (isset($shop->image)) {
            Storage::disk('public_uploads')->delete($shop->image);
        }
        $shop->delete();

        return redirect()->route('admin.shops.index')->with('success', __('site.deleted_successfully'));
    }
}
