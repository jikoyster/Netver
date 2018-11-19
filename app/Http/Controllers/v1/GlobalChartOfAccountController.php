<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GlobalChartOfAccount;
use App\AccountMap;
use App\AccountType;
use App\Sign;
use App\AccountGroup;
use App\AccountClass;
use Illuminate\Support\Facades\DB;

class GlobalChartOfAccountController extends Controller
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
        $gcoas = GlobalChartOfAccount::all();
        /*$account_maps = AccountMap::where('parent_id',null)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $account_maps = AccountMap::class_extractor($account_maps);*/
        $account_types = AccountType::all();
        $signs = Sign::all();
        $account_groups = AccountGroup::all();
        $account_classes = AccountClass::all();
        return view('v1.global-chart-of-accounts.index')
            ->with('gcoas',$gcoas)
            /*->with('account_maps',$account_maps)*/
            ->with('account_types',$account_types)
            ->with('signs',$signs)
            ->with('account_groups',$account_groups)
            ->with('account_classes',$account_classes);
    }

    public function ajaxIndex(Request $request)
    {
        $myObj = (object) [];
        $myObj->current = (int)$request->current;
        $myObj->rowCount = (int)$request->rowCount;
        $gcoas = GlobalChartOfAccount::take($myObj->rowCount)->skip(($myObj->rowCount * $myObj->current) - $myObj->rowCount)->get()->load('account_map','account_type','normal_sign','account_group','account_class');
        $myObj->rows = $gcoas;
        $myObj->total = GlobalChartOfAccount::count();

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
            return redirect()->route('global-chart-of-accounts')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'account_no' => 'required|unique:global_chart_of_accounts',
            'name' => 'required|unique:global_chart_of_accounts',
            'account_type_id' => 'required',
            'sign_id' => 'required',
            'account_group_id' => 'required',
            'account_class_id' => 'required'
        ]);
        $gcoa = new GlobalChartOfAccount;
        $gcoa->account_no = $request->account_no;
        $gcoa->name = $request->name;
        $gcoa->account_type_id = $request->account_type_id;
        $gcoa->sign_id = $request->sign_id;
        $gcoa->account_group_id = $request->account_group_id;
        $gcoa->account_class_id = $request->account_class_id;
        $gcoa->save();
        $response = 'New Account Class Added';
        auth()->user()->store_activity('added global chart of account - '.$gcoa->name);
        return redirect()->route('global-chart-of-accounts')->with('status',$response);
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
            return redirect()->route('global-chart-of-accounts')->with('status', trans('You don\'t have permission to edit.'));
        $gcoa = GlobalChartOfAccount::findOrFail($id);
        $account_maps = AccountMap::where('parent_id',null)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $account_maps = AccountMap::class_extractor($account_maps);
        $account_types = AccountType::all();
        $signs = Sign::all();
        $account_groups = AccountGroup::all();
        $account_classes = AccountClass::all();
        return view('v1.global-chart-of-accounts.edit')
            ->with('gcoa',$gcoa)
            ->with('account_maps',$account_maps)
            ->with('account_types',$account_types)
            ->with('signs',$signs)
            ->with('account_groups',$account_groups)
            ->with('account_classes',$account_classes);
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
            return redirect()->route('global-chart-of-accounts')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'account_no' => 'required|unique:global_chart_of_accounts,account_no,'.$id,
            'name' => 'required|unique:global_chart_of_accounts,name,'.$id,
            'account_type_id' => 'required',
            'sign_id' => 'required',
            'account_group_id' => 'required',
            'account_class_id' => 'required'
        ]);
        $gcoa = GlobalChartOfAccount::findOrFail($id);
        if(strtolower($gcoa->name) == strtolower($request->name))
            auth()->user()->store_activity('updated global chart of account - '.$gcoa->name);
        else
            auth()->user()->store_activity('updated global chart of account - '.$gcoa->name.' to '.$request->name);
        $gcoa->account_no = $request->account_no;
        $gcoa->name = $request->name;
        $gcoa->account_type_id = $request->account_type_id;
        $gcoa->sign_id = $request->sign_id;
        $gcoa->account_group_id = $request->account_group_id;
        $gcoa->account_class_id = $request->account_class_id;
        $gcoa->save();
        $response = 'Global Chart Of Account Updated';
        return redirect()->route('global-chart-of-accounts')->with('status',$response);
    }

    public function updateType(Request $request)
    {
        if($request->id) {
            $gcoa = GlobalChartOfAccount::findOrFail($request->gcoa_id);
            $data['id'] = $gcoa->id;
            if($request->type == 'map_no_id') {
                $gcoa->account_map_no = $request->id;
                $gcoa->save();
                $hold = '';
                if($gcoa->account_map->parent_map)
                    $hold = $gcoa->account_map->parent_map->map_no.'.';
                $hold .= $gcoa->account_map->map_no;
                $data['val'] = $hold;
            } elseif($request->type == 'type_id') {
                $gcoa->account_type_id = $request->id;
                $gcoa->save();
                $data['val'] = $gcoa->account_type->name;
            } elseif($request->type == 'sign_id') {
                $gcoa->sign_id = $request->id;
                $gcoa->save();
                $data['val'] = $gcoa->normal_sign->name;
            } elseif($request->type == 'group_id') {
                $gcoa->account_group_id = $request->id;
                $gcoa->save();
                $data['val'] = $gcoa->account_group->code.' - '.$gcoa->account_group->name;
            } elseif($request->type == 'class_id') {
                $gcoa->account_class_id = $request->id;
                $gcoa->save();
                $data['val'] = $gcoa->account_class->code.' - '.$gcoa->account_class->name;
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
            return redirect()->route('global-chart-of-accounts')->with('status', trans('You don\'t have permission to delete.'));
        $gcoa = GlobalChartOfAccount::findOrFail($id);
        auth()->user()->store_activity('deleted global chart of account - '.$gcoa->name);
        $gcoa->delete();
        $response = 'Account Class Deleted';
        return redirect()->route('global-chart-of-accounts')->with('status',$response);
    }
}
