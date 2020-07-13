<?php

namespace App\Http\Controllers\User;

use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\Subworker\StoreRequest;

class SubworkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-subworker|all-shoppermissions')->only('create');
        $this->middleware('permission:update-subworker|all-shoppermissions')->only('edit');
        $this->middleware('permission:delete-subworker|all-shoppermissions')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //gets the workers of the shop
        $subworkers = Shop::where('id', auth()->user()->shop_id)->first()->workers()->get();

        return view('users.subworkers.index')->with([
            'subworkers' => $subworkers,
            'page_name' => 'subworkers',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('creator_id', auth()->user()->id)->get();

        return view('users.subworkers.create')->with([
            'page_name' => parent::getPluralModelName(),
            'roles' => $roles,
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
        $data = $request->except(['password', 'image', 'dob', 'password_confirmation', 'roles']);

        $data['password'] = Hash::make($request->password);
        $date = strtotime($request->dob);
        $data['dob'] = date('Y-m-d', $date);
        $data['type'] = 3; //subworker
        $data['shop_id'] = auth()->user()->shop_id;
        $user = User::create($data);
        $user->syncRoles($request->roles);

        if ($request->image) {
            $image = parent::uploadImage($request->image);

            User::where('id', $user->id)->update(['image' => $image]);
        }

        return redirect()->route('user.subworkers.index')->with('success', __('site.created_successfully'));
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
        $user = User::findOrFail($id);
        $selectedRoles = $user->roles()->get()->pluck('id')->toArray();
        $roles = Role::where('creator_id', auth()->user()->id)->get();

        return view('users.subworkers.edit')->with([
            'page_name' => 'subwokers',
            'user' => $user,
            'selectedRoles' => $selectedRoles,
            'roles' => $roles,
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
        $user = User::findOrFail($id);
        $data = $request->except(['password', 'image', 'dob', 'password_confirmation', 'roles']);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $date = strtotime($request->dob);
        $data['dob'] = date('Y-m-d', $date);

        if ($request->image) {
            Storage::disk('public_uploads')->delete($user->image);

            $data['image'] = parent::uploadImage($request->image);
        }
        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('user.subworkers.index')->with('success', __('site.edit_successfully'));
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
        $user = User::findOrFail($id);
        $user->syncRoles([]);
        if (isset($user->image)) {
            Storage::disk('public_uploads')->delete($user->image);
        }
        $user->delete();

        return redirect()->route('user.subworkers.index')->with('success', __('site.deleted_successfully'));
    }
}
