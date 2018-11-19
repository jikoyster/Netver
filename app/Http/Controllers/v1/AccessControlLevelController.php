<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AccessControlLevel;
use App\Feature;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class AccessControlLevelController extends Controller
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
        $roles = Role::where('enabled',1)->get();
        $features = Feature::all();
        $acls = AccessControlLevel::all();
        return view('v1.access-control-levels.index')
            ->with('permissions',$permissions)
            ->with('roles',$roles)
            ->with('features',$features)
            ->with('acls',$acls);
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

    public function acl_validator($request, $id = null)
    {
        Validator::extend('acl_unique', function ($attribute, $value, $parameters, $validator) use ($request, $id){
            $acls = AccessControlLevel::where('role_id',$value)->where('url',$request->url)->where('parameter',$request->parameter);
            if($id)
                $acls->where('id','!=',$id);
            
            $integerIDs = array_map('intval', $request->permissions);

            if($acls->count()) {
                foreach($acls->get() as $acl) {
                    $features = $acl->features()->where('id',$request->feature_id)->count();

                    $first = $acl->permissions->pluck('id')->diff($integerIDs)->count();
                    $second = collect($integerIDs)->diff($acl->permissions->pluck('id'))->keys()->count();
                    $result = $first || $second ? false : true;
                    $result = $features && $result ? true : false;
                    if($result)
                        return false;
                }
            } else {
                $result = $acls->count();
            }

            return $result ? false : true; //false = already existed
        });

        $validator = $request->validate([
            'role_id' => 'required|acl_unique',
            'feature_id' => 'required',
            'url'=> 'required',
            'parameter' => 'required',
            'enabled' => '',
            'permissions' => 'required'
        ],[
            'acl_unique' => 'ACL already existed'
        ]);
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
            return redirect()->route('acls')->with('status', trans('You don\'t have permission to add.'));
        $this->acl_validator($request);

        $acl = new AccessControlLevel;
        $acl->role_id = $request->role_id;
        $acl->url = $request->url;
        $acl->parameter = $request->parameter;
        $acl->enabled = $request->enabled ? 1 : 0;
        auth()->user()->access_control_level()->save($acl);

        /*$acl->permissions()->detach();
        foreach($request->permissions as $permission_id) {
            $acl->permissions()->attach($permission_id,['model_type'=>'App\AccessControlLevel']);
        }*/

        $acl->features()->sync($request->feature_id);

        auth()->user()->store_activity('added ACL - #'.$acl->id);
        $response = 'New ACL Added!';

        return redirect()->route('acls')->with('status', trans($response));
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
            return redirect()->route('acls')->with('status', trans('You don\'t have permission to edit.'));
        $roles = Role::where('enabled',1)->get();
        $features = Feature::all();
        $permissions = Permission::all();
        $acl = AccessControlLevel::findOrFail($id);
        return view('v1.access-control-levels.edit')
            ->with('roles',$roles)
            ->with('features',$features)
            ->with('permissions',$permissions)
            ->with('acl',$acl);
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
            return redirect()->route('acls')->with('status', trans('You don\'t have permission to edit.'));
        $this->acl_validator($request, $id);

        $acl = AccessControlLevel::findOrFail($id);

        $response = 'ACL Updated!';
        auth()->user()->store_activity('updated ACL - #'.$acl->id);

        $acl->role_id = $request->role_id;
        $acl->url = $request->url;
        $acl->parameter = $request->parameter;
        $acl->enabled = $request->enabled ? 1 : 0;
        $acl->save();

        /*$acl->permissions()->detach();
        foreach($request->permissions as $permission_id) {
            $acl->permissions()->attach($permission_id,['model_type'=>'App\AccessControlLevel']);
        }*/

        $acl->features()->sync($request->feature_id);

        return redirect()->route('acls')->with('status', trans($response));
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
            return redirect()->route('acls')->with('status', trans('You don\'t have permission to delete.'));
        $acl = AccessControlLevel::find($id);

        $response = 'ACL Deleted!';
        auth()->user()->store_activity('deleted ACL - #'.$acl->id);

        $acl->permissions()->detach();
        $acl->features()->detach();
        $acl->delete();
        return redirect()->route('acls')->with('status', trans($response));
    }

    public function features($id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $acl = AccessControlLevel::findOrFail($id);
        $features = Feature::all();
        $aclFeatures = $acl->features()->get();
        return view('v1.access-control-levels.index-features')
            ->with('acl',$acl)
            ->with('features',$features)
            ->with('aclFeatures',$aclFeatures);
    }

    public function storeFeature(Request $request, $id)
    {
        /*
         * 5-4-2018
         * this is not used due to the changes
         */
        $validator = $request->validate([
            'feature_id' => 'required',
        ]);

        $acl = AccessControlLevel::findOrFail($id);
        $feature = Feature::find($request->feature_id);
        if($feature) {
            if(!$acl->features->where('id',$feature->id)->count()) {
                $acl->features()->attach($feature->id);
                $response = 'New Feature Added!';
                auth()->user()->store_activity('added '.$feature->name.' feature to ACL #'.$acl->id);
            } else {
                $response = 'Feature Already Existed!';
            }
        } else $response = '';
        return redirect()->route('acl.features',[$id])->with('status', trans($response));
    }

    public function destroyFeature($id, $feature_id)
    {
        /*
         * 5-4-2018
         * this is not used due to the changes
         */
        if(!$this->authenticate_local())
            return redirect()->route('home');
        if(!auth()->user()->can('delete'))
            return redirect()->route('acl.features',[$id])->with('status', trans('You don\'t have permission to delete.'));
        $feature = Feature::find($feature_id);
        $acl = AccessControlLevel::find($id);
        $acl->features()->detach($feature->id);
        $response = 'ACL Feature Deleted!';
        auth()->user()->store_activity('remove '.$feature->name.' feature to ACL #'.$acl->id);
        
        return redirect()->route('acl.features',[$id])->with('status', trans($response));
    }

    public function permissions($id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $acl = AccessControlLevel::findOrFail($id);
        $permissions = Permission::all();
        $aclPermissions = $acl->permissions()->get();
        return view('v1.access-control-levels.index-permissions')
            ->with('acl',$acl)
            ->with('permissions',$permissions)
            ->with('aclPermissions',$aclPermissions);
    }

    public function storePermission(Request $request, $id)
    {
        /*
         * 5-4-2018
         * this is not used due to the changes
         */
        $validator = $request->validate([
            'permission_id' => 'required',
        ]);

        $acl = AccessControlLevel::findOrFail($id);
        $permission = Permission::find($request->permission_id);
        if($permission) {
            if(!$acl->permissions->where('id',$permission->id)->count()) {
                $acl->permissions()->attach($permission->id,['model_type'=>'App\AccessControlLevel']);
                $response = 'New Permission Added!';
                auth()->user()->store_activity('added '.$permission->name.' permission to ACL #'.$acl->id);
            } else {
                $response = 'Permission Already Existed!';
            }
        } else $response = '';
        return redirect()->route('acl.permissions',[$id])->with('status', trans($response));
    }

    public function destroyPermission($id, $permission_id)
    {
        /*
         * 5-4-2018
         * this is not used due to the changes
         */
        if(!$this->authenticate_local())
            return redirect()->route('home');
        if(!auth()->user()->can('delete'))
            return redirect()->route('role.permissions',[$id])->with('status', trans('You don\'t have permission to delete.'));
        $permission = Permission::find($permission_id);
        $acl = AccessControlLevel::find($id);
        $acl->permissions()->detach($permission->id);
        $response = 'ACL Permission Deleted!';
        auth()->user()->store_activity('remove '.$permission->name.' permission to ACL #'.$acl->id);
        
        return redirect()->route('acl.permissions',[$id])->with('status', trans($response));
    }
}
