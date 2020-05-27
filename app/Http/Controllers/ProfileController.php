<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\User\StoreRequest;

class ProfileController extends Controller
{
    public function index()
    {
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $selectedRoles = $user->roles()->get()->pluck('id')->toArray();
        $roles = Role::all();

        return view('back.profile.edit')->with([
            'page_name' => parent::getPluralModelName(),
            'user' => $user,
            'selectedRoles' => $selectedRoles,
            'roles' => $roles,
        ]);
    }

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

        if (auth()->user()->type != 0) {
            return redirect()->route('user.subworkers.index')->with('success', __('site.edit_successfully'));
        }

        return redirect()->route('profile.show', $user->id)->with('success', __('site.edit_successfully'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->get()->first();

        $type = '';

        if ($user->type === 0) {
            $type = Lang::get('site.admin');
        } elseif ($user->type === 1) {
            $type = Lang::get('site.seller');
        } else {
            $type = Lang::get('site.provider');
        }

        return view('back.profile.index')->with([
            'page_name' => parent::getPluralModelName(),
            'user' => $user,
            'type' => $type,
        ]);
    }
}
