<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Permission;
use Auth;

class PermissionController extends Controller
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
        $permissions = Permission::all();
        return view('v1.permissions.index')
            ->with('permissions',$permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            return redirect()->route('permissions')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = new Permission;
        $permission->name = strtolower($request->name);
        $permission->guard_name = 'web';
        $permission->save();

        auth()->user()->store_activity('added permission - '.$permission->name);

        $response = 'New Permission Added!';
        return redirect()->route('permissions')->with('status', trans($response));
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
            return redirect()->route('permissions')->with('status', trans('You don\'t have permission to edit.'));
        $permission = Permission::findOrFail($id);
        return view('v1.permissions.edit')
            ->with('permission',$permission);
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
            return redirect()->route('permissions')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:permissions,name,'.$id
        ]);

        $permission = Permission::findOrFail($id);
        if($id < 5) {
            $response = '"'.ucwords($permission->name).'" Permission Cannot be Updated!';
        } else {
            auth()->user()->store_activity('updated permission - '.$permission->name.' to '.$request->name);
            $permission->name = $request->name;
            $permission->save();
            $response = 'Permission Updated!';
        }
        return redirect()->route('permissions')->with('status', trans($response));
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
            return redirect()->route('permissions')->with('status', trans('You don\'t have permission to delete.'));
        $permission = Permission::find($id);
        if($id < 5) {
            $response = '"'.ucwords($permission->name).'" Permission Cannot be Deleted!';
        } else {
            if($permission->roles()->count())
                $response = 'Permission Used, Cannot be Deleted!';
            else {
                auth()->user()->store_activity('deleted permission - '.$permission->name);
                $permission->delete();
                $response = 'Permission Deleted!';
            }
        }
        return redirect()->route('permissions')->with('status', trans($response));
    }
}
