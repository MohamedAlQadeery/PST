<?php

namespace App\Http\Controllers\Back;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\User\StoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'users';

    public function index()
    {
        $users = User::where('type', '!=', 0)->get();

        return view('back.user.index')->with([
            'users' => $users,
            'page_name' => $this->page_name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.user.create')->with([
            'page_name' => $this->page_name,
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
        $data = $request->except(['password', 'image', 'dob', 'password_confirmation']);

        $data['password'] = Hash::make($request->password);
        $date = strtotime($request->dob);
        $data['dob'] = date('Y-m-d', $date);
        $user = User::create($data);
        if ($request->image) {
            $image = parent::uploadImage($request->image);

            User::where('id', $user->id)->update(['image' => $image]);
        }

        return redirect()->route('users.index')->with('success', __('site.created_successfully'));
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

        return view('back.user.edit')->with([
            'page_name' => $this->page_name,
            'user' => $user,
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
        $data = $request->except(['password', 'image', 'dob', 'password_confirmation']);

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

        return redirect()->route('users.index')->with('success', __('site.edit_successfully'));
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

        return redirect()->route('users.index')->with('success', __('site.deleted_successfully'));
    }
}
