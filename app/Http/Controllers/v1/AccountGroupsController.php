<?php

namespace App\Http\Controllers\v1;

use App\AccountGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AccountGroupsController extends Controller
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
        $account_groups = AccountGroup::where('parent_id',null)->get();
        $account_groups = AccountGroup::group_extractor($account_groups);
        $parent_groups = AccountGroup::where('has_children',1)->get();
        return view('v1.account-groups.index')
            ->with('account_groups',$account_groups)
            ->with('parent_groups',$parent_groups);
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
            return redirect()->route('account-groups')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('code_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return AccountGroup::where('parent_id',$request->parent_id)->where('code',$value)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required',
            'code' => 'required|code_unique'
        ],['code_unique'=>'Code already existed']);
        $account_group = new AccountGroup;
        $account_group->code = $request->code;
        $account_group->name = $request->name;
        $account_group->parent_id = $request->parent_id;
        $account_group->has_children = $request->has_children ? 1 : 0;
        $account_group->save();
        $response = 'New Account Group Added';
        auth()->user()->store_activity('added account group - '.$account_group->name);
        return redirect()->route('account-groups')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountGroup  $accountGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountGroup  $accountGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('account-groups')->with('status', trans('You don\'t have permission to edit.'));
        $account_group = AccountGroup::findOrFail($id);
        $parent_groups = AccountGroup::where('id','!=',$id)->where('has_children',1)->get();
        return view('v1.account-groups.edit')
            ->with('account_group',$account_group)
            ->with('parent_groups',$parent_groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountGroup  $accountGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('account-groups')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('code_unique', function ($attribute, $value, $parameters, $validator) use ($request,$id){
            return AccountGroup::where('id','!=',$id)->where('parent_id',$request->parent_id)->where('code',$value)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required',
            'code' => 'required|code_unique'
        ],['code_unique'=>'Code already existed']);
        $account_group = AccountGroup::findOrFail($id);
        AccountGroup::where('parent_id',$id)->update(['parent_id'=>null]);
        if(strtolower($account_group->name) == strtolower($request->name))
            auth()->user()->store_activity('updated account group - '.$account_group->name);
        else
            auth()->user()->store_activity('updated account group - '.$account_group->name.' to '.$request->name);
        $account_group->code = $request->code;
        $account_group->name = $request->name;
        $account_group->parent_id = $request->parent_id;
        $account_group->has_children = $request->has_children ? 1 : 0;
        $account_group->save();
        $response = 'Account Group Updated';
        return redirect()->route('account-groups')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountGroup  $accountGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('account-groups')->with('status', trans('You don\'t have permission to delete.'));
        $account_group = AccountGroup::findOrFail($id);
        if(
            $account_group->gcoas->count()
            || $account_group->account_maps->count()
            || $account_group->company_account_maps->count()
            || $account_group->company_chart_of_accounts->count()
            || $account_group->map_group_lists->count()
            || $account_group->child_group->count())
            return redirect()->route('account-groups')->with('status','Account Group Used, Cannot be deleted.');
        AccountGroup::where('parent_id',$id)->update(['parent_id'=>null]);
        auth()->user()->store_activity('deleted account group - '.$account_group->name);
        $account_group->delete();
        $response = 'Account Group Deleted';
        return redirect()->route('account-groups')->with('status',$response);
    }
}
