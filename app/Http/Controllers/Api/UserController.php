<?php

namespace App\Http\Controllers\Api;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\User\StoreRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{


    public function index()
    {

        // $users = User::where('type', '!=', 0)->get();

        $users = User::paginate(10);
        return parent::success($users);
    }



    public function store(Request $request)
    {

        // dd($request->all());
        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }


        $data = $request->except(['password', 'image', 'dob', 'password_confirmation', 'roles']);

        $data['password'] = Hash::make($request->password);
        $date = strtotime($request->dob);
        $data['dob'] = date('Y-m-d', $date);
        $user = User::create($data);
        $user->syncRoles($request->roles);

        if ($request->image) {
            $image = parent::uploadImage($request->image);

            User::where('id', $user->id)->update(['image' => $image]);
        }

        // return response()->json(['message'=>'user saved successfully'],200);
        // return parent::success('user saved successfully');
        return parent::success($user);
    }


    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), $this->rules('patch', $id));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

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

        return parent::success($user);
    }


    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return parent::success($user);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('user not found');
        }
    }

    public function destroy($id = null)
    {
       
        try {
            $user = User::findOrFail($id);
            $user->syncRoles([]);
            if (isset($user->image)) {
                Storage::disk('public_uploads')->delete($user->image);
            }
            $user->delete();
            return $this->success($user);
        } catch (\Exception $exception) {
            return parent::error('user not found');
        }
    }


    private function rules($method, $id = null)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'numeric'],
            'dob' => ['required'],
            'gender' => ['required'],
            'type' => ['required'],
            'mobile_number' => ['required'],
            'roles' => 'required',
            'roles.*' => 'required',
        ];

        if ($method == 'post') {
            $rules += [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        }

        if ($method == 'patch') {
            // $user = '';
            // if ($this->profile) {
            //     $user = $this->profile;
            // } else {
            //     $user = $this->user;
            // }

            $rules += [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
            ];
        }

        return $rules;
    }
}
