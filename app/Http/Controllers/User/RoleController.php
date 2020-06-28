<?php

namespace App\Http\Controllers\User;

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
    public function __construct(Role $model)
    {
        $this->middleware('permission:create-shoproles|all-shoppermissions')->only('create');
        $this->middleware('permission:update-shoproles|all-shoppermissions')->only('edit');
        $this->middleware('permission:delete-shoproles|all-shoppermissions')->only('destroy');

        parent::__construct($model);
    }

    public function index()
    {
        $roles = Role::where('creator_id', auth()->user()->id)->get();

        return view('users.role.index')->with([
            'page_name' => parent::getPluralModelName(),
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('type', 1)->get();

        return view('users.role.create')->with([
            'page_name' => parent::getPluralModelName(),
            'permissions' => $permissions,
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
        $role = Role::create(['name' => $request->name, 'creator_id' => auth()->user()->id]);
        $role->syncPermissions($request->permissions);
        Alert::success(__('site.success'), __('site.created_successfully'));

        return redirect()->route('user.shoprole.index');
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
        $role = Role::findOrFail($id);
        $selectedPermissions = $role->permissions()->get()->pluck('id')->toArray();
        $permissions = Permission::all();

        return view('back.role.edit')->with([
            'role' => $role,
            'page_name' => parent::getPluralModelName(),
            'selectedPermissions' => $selectedPermissions,
            'permissions' => $permissions,
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
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        Alert::success(__('site.success'), __('site.edit_successfully'));

        return redirect()->route('user.shoprole.index');
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
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();
        Alert::success(__('site.success'), __('site.deleted_successfully'));

        return redirect()->route('user.shoprole.index');
    }
}
