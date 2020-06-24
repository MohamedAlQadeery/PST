<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = User::where('type', 2)->orderBy('id', 'DESC')->paginate(3);

        //gets the providers with at least 5 reviews with 3 stars or more
        $reviewd_providers = User::where('type', 2)->whereHas('providerReviews', function ($query) {
            $query->where('stars', '>=', '3');
        }, '>=', 5)->get();

        return view('site.provider.index')->with([
            'providers' => $providers,
            'reviewd_providers' => $reviewd_providers,
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
        $provider = User::with(['products', 'reviews'])->where(['id' => $id, 'type' => 2])->first();

        //gets the providers with at least 5 reviews with 3 stars or more
        $reviewd_providers = User::where('type', 2)->whereHas('reviews', function ($query) {
            $query->where('stars', '>=', '3');
        }, '>=', 5)->get();

        return view('site.provider.show')->with([
            'provider' => $provider,
            'reviewd_providers' => $reviewd_providers,
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
