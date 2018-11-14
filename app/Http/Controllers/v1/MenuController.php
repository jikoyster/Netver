<?php

namespace App\Http\Controllers\v1;

use App\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as Request1;

use Auth;
use Spatie\Permission\Models\Role;
use App\MenuRole;
use App\Group;
use App\MenuSet;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $menus = Menu::where('parent_id',null)->get();
        $menus = Menu::menu_extractor($menus);
        $parents = Menu::where('has_children',1)->get();
        $groups = Group::all();
        
        return view('v1.menus.index')
            ->with('menus',$menus)
            ->with('parents',$parents)
            ->with('groups',$groups);
    }

    public function newIndex()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $menus = Menu::where('parent_id',null)->get();
        $groups = Group::all();
        
        return view('v1.menus.new-index')
            ->with('menus',$menus)
            ->with('groups',$groups);
    }

    public function menuElementsIndex($id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $menus = Menu::where('id',$id)->get();
        $menus = Menu::menu_extractor($menus);
        $parents = $menus->where('has_children',1);
        $groups = Group::all();
        
        return view('v1.menus.new-index-menu-elements')
            ->with('menus',$menus)
            ->with('parents',$parents)
            ->with('groups',$groups);
    }

    public function dataByGroup($id)
    {
        $group_id = $id ? $id : null;
        if($id) {
            /*$menus = Group::findOrFail($id)->menus()->where('parent_id',null)->get();*/
            $menus = Menu::where('id',$id)->get();
        }
        else
            $menus = Menu::where('parent_id',null)->get();
        $menus = Menu::menu_extractor($menus);
        return view('v1.menus.index-table')
            ->with('menus',$menus)
            ->with('group_id',$group_id);
    }

    public function roles($parent_id, $id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $menu = Menu::findOrFail($id);
        $roles = Role::where('enabled',1)->get();
        $menu_roles = $menu->roles()->get();
        return view('v1.menus.index-menu-role')
            ->with('menu',$menu)
            ->with('roles',$roles)
            ->with('menu_roles',$menu_roles);
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
        return view('v1.menus.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id = null)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:menus',
            'group_id'  => ''
        ]);

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->icon = '';
        if(!$request->has_children)
            $menu->link = str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($request->link)));
        $menu->parent_id = $request->parent_id;
        $menu->has_children = $request->has_children ? 1 : 0;
        $menu->order = $request->order ? $request->order : 0;
        $menu->save();
        
        if($request->parent_id) {
            $p_menu = Menu::find($request->parent_id);
            foreach($p_menu->roles->pluck('id') as $role_id) {
                $menu->roles()->attach($role_id,['model_type'=>'App\Menu']);
            }
        } else {
            if($request->group_id) {
                $menu->roles()->attach(2,['model_type'=>'App\Menu']); // 2 = admin
            } else {
                $menu->roles()->attach(1,['model_type'=>'App\Menu']); // 1 = system admin
            }
        }

        $response = 'New Menu Added!';
        if($id)
            return redirect()->route('menu-elements',[$id])->with('status', trans($response));
        else
            return redirect()->route('menus')->with('status', trans($response));
    }

    public function storeRole(Request $request, $parent_id, $id)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('menu.roles',[$parent_id,$id])->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'role_id' => 'required',
        ],['role_id.required'=>'Select a Role']);

        $menu = Menu::findOrFail($id);

        if($menu->parent_id) {
            $this->storeRoleParent($menu->parent_id, $request->role_id);
        }

        $count = $menu->roles()->where('role_id',$request->role_id)->count();

        if($count < 1) {
            $menu->roles()->attach($request->role_id,['model_type'=>'App\Menu']);
            if($menu->child_menu->count())
                $this->storeRoleChild($menu->child_menu, $request->role_id);
            $response = 'New Role Added';
            Auth::user()->store_activity(Role::find($request->role_id)->name.' role is added to '.$menu->name.' menu under '.$menu->menu_set->name);
        } else $response = 'Role Already Existed';
        return redirect()->route('menu.roles',[$parent_id,$id])->with('status', trans($response));
    }

    public function storeRoleParent($parent_id, $role_id)
    {
        $menu = Menu::find($parent_id);
        if($menu->roles()->where('role_id',$role_id)->count() < 1)
            $menu->roles()->attach($role_id,['model_type'=>'App\Menu']);
        if($menu->parent_id) {
            $this->storeRoleParent($menu->parent_id, $role_id);
        }

    }

    public function storeRoleChild($menus, $role_id)
    {
        foreach($menus as $rec) {
            $menu = Menu::find($rec->id);
            $menu->roles()->attach($role_id,['model_type'=>'App\Menu']);
            if($menu->child_menu->count())
                $this->storeRoleChild($menu->child_menu, $role_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function editMenuElement($parent_id,$id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('menu-elements',[$parent_id])->with('status', trans('You don\'t have permission to edit.'));
        $menu = Menu::findOrFail($id);
        $parents = $menu->menu_set->menus()->where('has_children',1)->get();
        $groups = Group::all();
        return view('v1.menus.new-edit-menu-element')
            ->with('menu',$menu)
            ->with('parents',$parents)
            ->with('groups',$groups);
    }

    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to edit.'));
        $menu = Menu::findOrFail($id);
        $parents = Menu::where('has_children',1)->get();
        $groups = Group::all();
        return view('v1.menus.new-edit')
            ->with('menu',$menu)
            ->with('parents',$parents)
            ->with('groups',$groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $parent_id = null)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to edit.'));
        Validator::extend('menu_element_unique', function ($attribute, $value, $parameters, $validator) use ($parent_id, $request){
            return MenuSet::find($parent_id)->menus()->where('name',$value)->where('id','!=',$request->id)->count() ? false : true;
        });

        $validator = $request->validate([
            'name' => 'required'
        ],['menu_element_unique'=>'Menu already existed under this menu set!']);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->link = str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($request->link)));
        $menu->order = $request->order ? $request->order : 0;
        if($menu->parent_id != $request->parent_id) {
            $menu->parent_id = $request->parent_id;
            $p_menu = Menu::find($request->parent_id);
            if($p_menu && $p_menu->roles->count()) {
                $menu->roles()->detach();
                foreach($p_menu->roles->pluck('id') as $role_id) {
                    $menu->roles()->attach($role_id,['model_type'=>'App\Menu']);
                    $role[$role_id] = ['model_type'=>'App\Menu'];
                }
                if($menu->child_menu->count())
                    $this->updateChild($menu->child_menu, $role);
            } else {
                if($menu->menu_set->groups->count()) {
                    $role_id = 2; // 2 = admin
                } else {
                    $role_id = 1; // 1 = system admin
                }
                
                $menu->roles()->sync($role_id,['model_type'=>'App\Menu']);

                if($menu->child_menu->count())
                    $this->updateChild($menu->child_menu, [$role_id => ['model_type'=>'App\Menu']]);
            }
        }

        $menu->has_children = $request->has_children ? 1 : 0;
        $menu->company_related = $request->company_related ? 1 : 0;
        $menu->save();


        

        $response = 'Menu Updated!';
        Auth::user()->store_activity('updated menu - '.$menu->name.' under '.$menu->menu_set->name);

        if($parent_id)
            return redirect()->route('menu-elements',[$parent_id])->with('status', trans($response));
        else
            return redirect()->route('menus')->with('status', trans($response));
    }

    public function updateChild($menus, $role)
    {
        foreach($menus as $rec) {
            $menu = Menu::find($rec->id);
            
            $menu->roles()->sync($role);

            if($menu->child_menu->count())
                $this->updateChild($menu->child_menu, $role);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to delete.'));
        $menu = Menu::find($id);
        if($menu['has_children'] != '' && $menu->children($menu['id'])->count()) {
            $response = 'Menu Used, Cannot be Deleted!';
        } else {
            $menu->roles()->detach();
            $menu->destroy($id);
            $response = 'Menu Deleted!';
        }
        return redirect()->route('menus')->with('status', trans($response));
    }

    public function destroyMenuElement($id,$parent_id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('menu-elements',[$parent_id])->with('status', trans('You don\'t have permission to delete.'));
        $menu = Menu::find($id);
        if($menu['has_children'] != '' && $menu->children($menu['id'])->count()) {
            $response = 'Menu Used, Cannot be Deleted!';
            return redirect()->route('menu-elements',[$parent_id])->with('status', trans($response));
        } else {
            Auth::user()->store_activity('deleted menu - '.$menu->name.' under '.$menu->menu_set->name);
            $menu->roles()->detach();
            $menu->destroy($id);
            $response = 'Menu Deleted!';
        }
        if($id != $parent_id)
            return redirect()->route('menu-elements',[$parent_id])->with('status', trans($response));
        else
            return redirect()->route('menus')->with('status', trans($response));
    }

    public function destroyRole($parent_id, $id, $role_id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('menu.roles',[$parent_id,$id])->with('status', trans('You don\'t have permission to delete.'));

        $menu = Menu::findOrFail($id);
        $menu_role = $menu->roles()->where('role_id',$role_id);
        if($menu_role->count()) {
            Auth::user()->store_activity('removed '.$menu_role->first()->name.' role from '.$menu->name.' menu under '.$menu->menu_set->name);
            $menu_role->detach($role_id);
            /* this is to delete roles upward */
            /*if($menu->parent_id)
                $this->destroyRoleParent($menu->parent_id, $role_id);*/
            /* end delete roles upward */
            $response = 'Menu Role Deleted!';
            if($menu->child_menu->count())
                $this->destroyRoleChild($menu->child_menu, $role_id);
        }
        else
            $response = "No Role Deleted!";
        
        return redirect()->route('menu.roles',[$parent_id,$id])->with('status', trans($response));
    }

    public function destroyRoleParent($parent_id, $role_id)
    {
        $menu = Menu::find($parent_id);
        $menu_role = $menu->roles()->where('role_id',$role_id);
        if($menu_role->count())
            $menu_role->detach($role_id);
        if($menu->parent_id)
            $this->destroyRoleParent($menu->parent_id, $role_id);

    }

    public function destroyRoleChild($menus, $role_id)
    {
        foreach($menus as $rec) {
            $menu = Menu::find($rec->id);
            $menu_role = $menu->roles()->where('role_id',$role_id);
            if($menu_role->count())
                $menu_role->detach($role_id);
            if($menu->child_menu->count())
                $this->destroyRoleChild($menu->child_menu, $role_id);
        }
    }

    /*
     * March 26, 2018
     * this is for the latest menu module methods
     */

    public function index032618()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $menus = MenuSet::all();
        $groups = Group::all();
        
        return view('v1.menus.032618.index')
            ->with('menus',$menus)
            ->with('groups',$groups);
    }

    public function storeMenuSet(Request $request,$id = null)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:menu_sets',
            'group_id'  => ''
        ]);

        $menu_set = new MenuSet;
        $menu_set->name = $request->name;
        $menu_set->save();
        
        $menu_set->groups()->attach($request->group_id);

        $response = 'New Menu Set Added!';
        Auth::user()->store_activity('added new menu set - '.$menu_set->name);

        return redirect()->route('menus')->with('status', trans($response));
    }

    public function edit032618($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to edit.'));
        $menu = MenuSet::findOrFail($id);
        $groups = Group::all();
        return view('v1.menus.032618.edit')
            ->with('menu',$menu)
            ->with('groups',$groups);
    }

    public function update032618(Request $request, $id, $parent_id = null)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:menu_sets,name,'.$request->id,
            'group_id' => ''
        ]);

        $menu_set = MenuSet::findOrFail($id);
        $menu_set->name = $request->name;
        $menu_set->save();
        $menu_set->groups()->sync($request->group_id);

        $response = 'Menu Set Updated!';
        Auth::user()->store_activity('updated menu set - '.$menu_set->name);
        
        return redirect()->route('menus')->with('status', trans($response));
    }

    public function menuElementsIndex032618($id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $menu_set = MenuSet::find($id);
        $menus = $menu_set->menus()->where('parent_id',null)->get();
        $menus = Menu::menu_extractor($menus);
        $parents = $menus ? $menus->where('has_children',1) : [];
        $groups = Group::all();
        
        return view('v1.menus.032618.index-menu-elements')
            ->with('menu_set',$menu_set)
            ->with('menus',$menus)
            ->with('parents',$parents)
            ->with('groups',$groups);
    }

    public function store032618(Request $request,$id = null)
    {
        if(!auth()->user()->can('add')) {
            if($id)
                return redirect()->route('menu-elements',[$id])->with('status', trans('You don\'t have permission to add.'));
            else
                return redirect()->route('menus')->with('status', trans('You don\'t have permission to add.'));
        }
        Validator::extend('menu_element_unique', function ($attribute, $value, $parameters, $validator) use ($id){
            return MenuSet::find($id)->menus()->where('name',$value)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required',
            'group_id'  => ''
        ],['menu_element_unique'=>'Menu already existed under this menu set!']);

        $menu_set = MenuSet::find($id);
        
        $menu = new Menu;

        $menu->name = $request->name;
        $menu->icon = '';
        if(!$request->has_children)
            $menu->link = str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($request->link)));
        $menu->parent_id = $request->parent_id;
        $menu->has_children = $request->has_children ? 1 : 0;
        $menu->company_related = $request->company_related ? 1 : 0;
        $menu->order = $request->order ? $request->order : 0;
        $menu_set->menus()->save($menu);
        
        if($request->parent_id) {
            $p_menu = Menu::find($request->parent_id);
            foreach($p_menu->roles->pluck('id') as $role_id) {
                $menu->roles()->attach($role_id,['model_type'=>'App\Menu']);
            }
        } else {
            if($menu_set->groups->count()) {
                $menu->roles()->attach(2,['model_type'=>'App\Menu']); // 2 = admin
            } else {
                $menu->roles()->attach(1,['model_type'=>'App\Menu']); // 1 = system admin
            }
        }

        $response = 'New Menu Added!';
        Auth::user()->store_activity('added new menu - '.$menu->name.' under '.$menu_set->name);

        if($id)
            return redirect()->route('menu-elements',[$id])->with('status', trans($response));
        else
            return redirect()->route('menus')->with('status', trans($response));
    }

    public function destroy032618($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('menus')->with('status', trans('You don\'t have permission to delete.'));
        $menu_set = MenuSet::find($id);
        if($menu_set->menus->count()) {
            $response = 'Menu Used, Cannot be Deleted!';
        } else {
            Auth::user()->store_activity('deleted menu set - '.$menu_set->name);
            $menu_set->groups()->detach();
            $menu_set->destroy($id);
            $response = 'Menu Set Deleted!';
        }
        return redirect()->route('menus')->with('status', trans($response));
    }

    public function dataByGroup032618($id)
    {
        if($id)
            $menus = MenuSet::where('id',$id)->get();
        else
            $menus = MenuSet::all();
        
        return view('v1.menus.032618.index-table')
            ->with('menus',$menus);
    }
}
