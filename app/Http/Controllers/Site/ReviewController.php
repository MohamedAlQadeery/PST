<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;

class ReviewController extends Controller
{
    public function providerReview(Request $request, $id)
    {
        $request->validate([
            'stars' => 'required',
            'body' => 'required',
        ]);
        $data = $request->except(['_token']);
        $data['provider_id'] = $id;
        $data['seller_id'] = auth()->user()->id;
        Review::create($data);

        return redirect()->route('site.providers.show', $id)->with('success', __('site.created_successfully'));
    }

    public function productReview(Request $request, $id)
    {
        $request->validate([
            'stars' => 'required',
            'body' => 'required',
        ]);
        $data = $request->except(['_token']);
        $data['product_id'] = $id;
        $data['seller_id'] = auth()->user()->id;

        Review::create($data);

        return redirect()->route('site.products.show', $id)->with('success', __('site.created_successfully'));
    }
}
