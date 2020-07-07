<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Review;
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
        $providers = User::where([]);

        if (request()->has('search')) {
            $providers = $providers->where('first_name', 'like', '%'.request()->input('search').'%')
            ;
        }

        $providers = $providers->where(['type' => 2])->paginate(3);

        //gets the providers with at least 5 reviews with 3 stars or more
        $reviewd_providers = User::where('type', 2)->whereHas('reviews', function ($query) {
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
        $provider = User::with(['products', 'reviews' => function ($q) {
            $q->orderBy('id', 'desc');
        }])->where(['id' => $id, 'type' => 2])->first();

        //gets the providers with at least 5 reviews with 3 stars or more
        $reviewd_providers = User::where('type', 2)->whereHas('reviews', function ($query) {
            $query->where('stars', '>=', '3');
        }, '>=', 5)->get();

        // getting the all rates from this provider
        $provider_rate = Review::where('provider_id', $provider->id)->get();

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

        return view('site.provider.show')->with([
            'provider' => $provider,
            'reviewd_providers' => $reviewd_providers,
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
