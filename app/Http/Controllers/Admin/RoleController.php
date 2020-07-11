<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show roles');
        $this->middleware('permission:create roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $roles)
    {
        return view('admin.acl.roles.index', ['roles' => $roles->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.acl.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.role.index')->withSuccess(__('Role successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Role $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Role $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Role $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.acl.roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Role $roles
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.role.index')->withSuccess(__('Role successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Role $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->users) {
            return redirect()->route('admin.role.index')->withError(__('Cannot delete Role. Please un role users first'));
        }
        $role->delete();
        return redirect()->route('admin.role.index')->withSuccess(__('Role successfully deleted.'));
    }
}
