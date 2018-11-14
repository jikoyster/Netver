<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AccountMap;
use App\AccountType;
use App\Sign;
use App\AccountClass;
use App\AccountGroup;
use Illuminate\Support\Facades\Validator;

class AccountMapController extends Controller
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
        $account_maps = AccountMap::all()->sortBy('map_no');
        $parent_maps = AccountMap::where('has_a_child',1)->get()->sortBy('map_no');
        $flip_tos = AccountMap::where('parent_id',null)->where('title',0)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $flip_tos = AccountMap::class_extractor($flip_tos);
        $account_types = AccountType::all();
        $signs = Sign::all();
        $account_classes = AccountClass::all();
        $account_groups = AccountGroup::all();
        return view('v1.account-maps.index')
            ->with('account_maps',$account_maps)
            ->with('parent_maps',$parent_maps)
            ->with('flip_tos',$flip_tos)
            ->with('account_types',$account_types)
            ->with('signs',$signs)
            ->with('account_classes',$account_classes)
            ->with('account_groups',$account_groups);
    }

    public function ajaxIndex(Request $request)
    {
        $myObj = (object) [];
        $myObj->current = (int)$request->current;
        $myObj->rowCount = (int)$request->rowCount;
        $gcoas = AccountMap::take($myObj->rowCount)->skip(($myObj->rowCount * $myObj->current) - $myObj->rowCount)->get()->load(['parent_map','account_type','normal_sign','account_class','flip_to_map'=>function($query){
            $query->with('parent_map');
        }]);
        $myObj->rows = $gcoas;
        $myObj->total = AccountMap::count();

        return json_encode($myObj);
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
            return redirect()->route('account-maps')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('map_no_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return AccountMap::where('map_no',$value)->where('parent_id',$request->parent_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'map_no' => 'required|integer|map_no_unique',
            'title' => '',
            'unassignable' => '',
            'name' => 'required',
            'parent_id' => '',
            'account_type_id' => 'required',
            'sign_id' => 'required',
            'account_class_id' => '',
            'account_group_id' => '',
            'flip_type' => '',
            'flip_to' => 'required_if:flip_type,value,Individual,Total is Debit,Total is Credit',
            'has_a_child' => '',
        ],['map_no_unique' => 'Map No. already existed.']);
        $account_map = new AccountMap;
        $account_map->map_no = $request->map_no;
        $account_map->title = $request->title ? 1 : 0;
        $account_map->unassignable = $request->unassignable ? 1 : 0;
        $account_map->name = $request->name;
        $account_map->parent_id = $request->parent_id;
        $account_map->account_type_id = $request->account_type_id;
        $account_map->sign_id = $request->sign_id;
        $account_map->account_group_id = $request->account_group_id;
        $account_map->account_class_id = $request->account_class_id;
        $account_map->flip_type = $request->flip_type ?: '';
        $account_map->flip_to = $request->flip_to;
        $account_map->has_a_child = $request->has_a_child ? 1 : 0;
        $account_map->save();
        $response = 'New Account Map Added';
        auth()->user()->store_activity('added account map - '.$account_map->name);
        return redirect()->route('account-maps')->with('status',$response);
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
            return redirect()->route('account-maps')->with('status', trans('You don\'t have permission to edit.'));
        $account_map = AccountMap::findOrFail($id);
        $parent_maps = AccountMap::where('id','!=',$id)->where('has_a_child',1)->get()->sortBy('map_no');
        $flip_tos = AccountMap::where('parent_id',null)->where('title',0)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $flip_tos = AccountMap::class_extractor($flip_tos);
        $account_types = AccountType::all();
        $signs = Sign::all();
        $account_classes = AccountClass::all();
        $account_groups = AccountGroup::all();
        return view('v1.account-maps.edit')
            ->with('account_map',$account_map)
            ->with('parent_maps',$parent_maps)
            ->with('flip_tos',$flip_tos)
            ->with('account_types',$account_types)
            ->with('signs',$signs)
            ->with('account_classes',$account_classes)
            ->with('account_groups',$account_groups);
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
            return redirect()->route('account-maps')->with('status', trans('You don\'t have permission to edit.'));
        Validator::extend('map_no_unique', function ($attribute, $value, $parameters, $validator) use ($id, $request){
            return AccountMap::where('id','!=',$id)->where('map_no',$value)->where('parent_id',$request->parent_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'map_no' => 'required|integer|map_no_unique',
            'title' => '',
            'unassignable' => '',
            'name' => 'required',
            'parent_id' => '',
            'account_type_id' => 'required',
            'sign_id' => 'required',
            'account_group_id' => '',
            'account_class_id' => '',
            'flip_type' => '',
            'flip_to' => 'required_if:flip_type,value,Individual,Total is Debit,Total is Credit',
            'has_a_child' => '',
        ],['map_no_unique' => 'Map No. already existed.']);
        $account_map = AccountMap::findOrFail($id);
        AccountMap::where('parent_id',$id)->update(['parent_id'=>null]);
        if(strtolower($account_map->name) == strtolower($request->name))
            auth()->user()->store_activity('updated account map - '.$account_map->name);
        else
            auth()->user()->store_activity('updated account map - '.$account_map->name.' to '.$request->name);
        $account_map->map_no = $request->map_no;
        $account_map->title = $request->title ? 1 : 0;
        $account_map->unassignable = $request->unassignable ? 1 : 0;
        $account_map->name = $request->name;
        $account_map->parent_id = $request->parent_id;
        $account_map->account_type_id = $request->account_type_id;
        $account_map->sign_id = $request->sign_id;
        $account_map->account_group_id = $request->account_group_id;
        $account_map->account_class_id = $request->account_class_id;
        $account_map->flip_type = $request->flip_type ?: '';
        $account_map->flip_to = $request->flip_to;
        $account_map->has_a_child = $request->has_a_child ? 1 : 0;
        $account_map->save();
        $response = 'Account Map Updated';
        return redirect()->route('account-maps')->with('status',$response);
    }

    public function parent_code($rec)
    {
        if($rec->parent_map) {
            $hold = $this->parent_code($rec->parent_map);
            return $rec->parent_map->map_no.'.'.$hold;
        }
    }

    public function updateType(Request $request)
    {
        if($request->id || $request->type == 'flip_to' || $request->type == 'flip_type') {
            $account_map = AccountMap::findOrFail($request->account_map_id);
            $data['id'] = $account_map->id;
            if($request->type == 'title') {
                $account_map->title = $request->id == 1 ? 1 : 0;
                $account_map->save();
                $data['val'] = $account_map->title ? 'Yes' : 'No';
            } elseif($request->type == 'unassignable') {
                $account_map->unassignable = $request->id == 1 ? 1 : 0;
                $account_map->save();
                $data['val'] = $account_map->unassignable ? 'Yes' : 'No';
            } elseif($request->type == 'flip_type') {
                if($request->id == 'xxx') {
                    $account_map->flip_type = '';
                    $account_map->flip_to = null;
                } else {
                    $account_map->flip_type = $request->id ?: '';
                }
                $account_map->save();
                $data['val'] = $account_map->flip_type ?: ' ';
            } elseif($request->type == 'flip_to') {
                $account_map->flip_to = $request->id;
                $account_map->save();
                if($account_map->flip_to_map) {
                    $hold = $this->parent_code($account_map->flip_to_map);
                    $hold = $hold.$account_map->flip_to_map->map_no;
                } else {
                    $hold = '';
                }
                $data['val'] = $hold;
            } elseif($request->type == 'account_type_id') {
                $account_map->account_type_id = $request->id;
                $account_map->save();
                $data['val'] = $account_map->account_type->name;
            } elseif($request->type == 'sign_id') {
                $account_map->sign_id = $request->id;
                $account_map->save();
                $data['val'] = $account_map->normal_sign ? $account_map->normal_sign->name:'';
            } elseif($request->type == 'account_class_id') {
                $account_map->account_class_id = $request->id;
                $account_map->save();
                $data['val'] = $account_map->account_class ? $account_map->account_class->name:'';
            } elseif($request->type == 'account_group_id') {
                $account_map->account_group_id = $request->id;
                $account_map->save();
                $data['val'] = $account_map->account_group ? $account_map->account_group->name:'';
            }
            return $data;
        }
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
            return redirect()->route('account-maps')->with('status', trans('You don\'t have permission to delete.'));
        $cannot = AccountMap::where('flip_to',$id)->count();
        $account_map = AccountMap::findOrFail($id);
        if($cannot || $account_map->global_chart_of_accounts->count())
            return redirect()->route('account-maps')->with('status','Map used, cannot be deleted.');
        AccountMap::where('parent_id',$id)->update(['parent_id'=>null]);
        auth()->user()->store_activity('deleted account map - '.$account_map->name);
        $account_map->delete();
        $response = 'Account Map Deleted';
        return redirect()->route('account-maps')->with('status',$response);
    }
}
