<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\MenuRole;
use App\AccessControlLevel;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $roles = Role::where('is_deleted',0)->get();
        $permissions = Permission::all();
        return view('v1.roles.index')
            ->with('roles',$roles)
            ->with('permissions',$permissions);
    }

    public function permissions($id, $ajax = false)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->get();
        if($ajax)
            return ['rolePermissions'=>$rolePermissions,'permissions'=>$permissions];
        return view('v1.roles.index-role-permission')
            ->with('role',$role)
            ->with('permissions',$permissions)
            ->with('rolePermissions',$rolePermissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        return view('v1.roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('roles')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);

        $role = new Role;
        $role->name = strtolower($request->name);
        $role->guard_name = 'web';
        $role->enabled = $request->enabled ? 1 : 0;
        if(auth()->user()->hasRole('super admin'))
            $role->is_system_role = $request->is_system_role ? 0 : 1;
        $role->save();
        auth()->user()->store_activity('added role - '.$role->name);

        foreach($request->permissions as $permission_id) {
            $permission = Permission::find($permission_id);
            $role->givePermissionTo($permission->name);
        }

        $response = 'New Role Added!';
        return redirect()->route('roles')->with('status', trans($response));
    }

    public function storePermission(Request $request, $id)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('role.permissions',[$id])->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'permission_id' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $permission = Permission::find($request->permission_id);
        if($permission) {
            if(!$role->hasPermissionTo($permission->name)) {
                $role->givePermissionTo($permission->name);
                $response = 'New Permission Added!';
                auth()->user()->store_activity('added '.$permission->name.' permission to '.ucwords($role->name).' role');
            } else {
                $response = 'Permission Already Existed!';
            }
        } else $response = '';
        return redirect()->route('role.permissions',[$id])->with('status', trans($response));
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
        if(!auth()->user()->can('edit'))
            return redirect()->route('roles')->with('status', trans('You don\'t have permission to edit.'));
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('v1.roles.edit')
            ->with('role',$role)
            ->with('permissions',$permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('roles')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'required'
        ]);

        $role = Role::findOrFail($id);
        if($role->name == strtolower($request->name))
            auth()->user()->store_activity('updated role - '.$role->name);
        else
            auth()->user()->store_activity('updated role - '.$role->name.' to '.strtolower($request->name));

        $role->enabled = $request->enabled ? 1 : 0;
        if(auth()->user()->hasRole('super admin'))
            $role->is_system_role = $request->is_system_role ? 0 : 1;

        if($id < 4) {
            $response[] = '"'.ucwords($role->name).'" Role name cannot be changed.';
            $role->save();
        } else {
            $response[] = 'Role Updated!';
            $role->name = strtolower($request->name);
            $role->save();
        }

        $role->permissions()->detach();
        foreach($request->permissions as $permission_id) {
            $permission = Permission::find($permission_id);
            $role->givePermissionTo($permission->name);
            $response[] = $permission->name.' permission assigned!';
        }

        return redirect()->route('roles')->with('status', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('roles')->with('status', trans('You don\'t have permission to delete.'));
        $role = Role::find($id);
        if($id < 0) {
            $response = '"'.ucwords($role->name).'" Role Cannot be Deleted.';
        } else {
            if($role->users()->count() || MenuRole::where('role_id',$id)->count() || AccessControlLevel::where('role_id',$id)->count())
                $response = '"'.ucwords($role->name).'" Role Used, Cannot be Deleted!';
            else {
                auth()->user()->store_activity('deleted role - '.$role->name);
                $role->enabled = 0;
                $role->is_deleted = 1;
                $role->save();
                $response = 'Role Deleted!';
            }
        }
        
        return redirect()->route('roles')->with('status', trans($response));
    }

    public function destroyPermission($id, $permission_id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('role.permissions',[$id])->with('status', trans('You don\'t have permission to delete.'));
        $permission = Permission::find($permission_id);
        $role = Role::find($id);
        $role->revokePermissionTo($permission->name);
        $response = 'Role Permission Deleted!';
        auth()->user()->store_activity('remove '.$permission->name.' permission to '.ucwords($role->name).' role');
        
        return redirect()->route('role.permissions',[$id])->with('status', trans($response));
    }
}
