<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Back\Role\StoreRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $page_name='roles';
    public function index()
    {
        //
        $roles = Role::all();
        return view('back.role.index')->with([
            'page_name'=>$this->page_name,
            'roles'=>$roles
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('back.role.create')->with([
            'page_name'=>$this->page_name,
            'permissions'=>$permissions
        ]);
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
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        Alert::success(__('site.success'),  __('site.created_successfully'));
        return redirect()->route('role.index');

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
        $role = Role::findOrFail($id);
        $selectedPermissions = $role->permissions()->get()->pluck('id')->toArray();
        $permissions = Permission::all();
        return view('back.role.edit')->with([
            'role'=>$role,
            'page_name'=>$this->page_name,
            'selectedPermissions'=>$selectedPermissions,
            'permissions'=>$permissions
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request , $id){
        $role = Role::findOrFail($id);
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        Alert::success(__('site.success'),  __('site.edit_successfully'));

        return redirect()->route('role.index');



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
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();
        Alert::success(__('site.success'),  __('site.deleted_successfully'));

        return redirect()->route('role.index');
    }
}
