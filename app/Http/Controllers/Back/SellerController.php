<?php

namespace App\Http\Controllers\Back;

use App\Shop;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Back\Seller\StoreRequest;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('back.seller.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //

        $seller_data = $request->except(['shop_name','shop_address','telephone_number','shop_email',
        'password','password_confirmation','dob','image']);
        $seller_data['password']= Hash::make($request->password);
        $seller_data['type']=1; //1 is seller 2 is provider
        $date = strtotime($request->dob);
        $seller_data['dob']=date('Y-m-d',$date);

        $user = User::create($seller_data);

        if($request->image){

            $image=parent::uploadImage($request->image,'seller\\'.$user->id);
            User::where('id',$user->id)->update(['image'=>$image]);

       }
        $shop_data=$request->only(['shop_name','shop_address','telephone_number','shop_email']);
        $shop_data['user_id'] = $user->id;
        $shop =Shop::create([
            'name'=>$shop_data['shop_name'],
            'address'=>$shop_data['shop_address'],
            'telephone_number'=>$shop_data['telephone_number'],
            'email'=>$shop_data['shop_email'],
            'user_id'=>$shop_data['user_id']
        ]);
        User::where('id',$user->id)->update(['shop_id'=>$shop->id]);
        Alert::success(__('site.success'),  __('site.registerd_successfully'));
        return redirect()->route('login');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
