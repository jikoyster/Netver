<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\AccountSplitItem;
use App\Company;

class AccountSplitItemController extends Controller
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
        $company = Company::find(session('selected-company'));
        $account_split_items = $company->account_split_items;
        $chart_of_accounts = $company->chart_of_accounts;
        return view('v1.account-split-items.index')
            ->with('account_split_items',$account_split_items)
            ->with('chart_of_accounts',$chart_of_accounts);
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
            return redirect()->route('account-split-items')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('unique_sub_account', function ($attribute, $value, $parameters, $validator) use ($request){
            return AccountSplitItem::where('account_no',$request->account_no)->where('sub_account_no',$request->sub_account_no)->where('sub_account_name',$request->sub_account_name)->count() ? false : true;
        });
        $validator = $request->validate([
            'account_no' => 'required|unique_sub_account',
            'sub_account_no' => 'required',
            'sub_account_name' => 'required|unique:account_split_items'
        ],['unique_sub_account' => 'Item already existed']);

        $company = Company::find(session('selected-company'));
        $account_split_item = new AccountSplitItem;
        $account_split_item->account_no = $request->account_no;
        $account_split_item->sub_account_no = $request->sub_account_no;
        $account_split_item->sub_account_name = $request->sub_account_name;
        $company->account_split_items()->save($account_split_item);

        $response = 'New Account Split Item Added!';
        auth()->user()->store_activity('added account split item - '.$account_split_item->sub_account_name);
        return redirect()->route('account-split-items')->with('status', trans($response));
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
            return redirect()->route('account-split-items')->with('status', trans('You don\'t have permission to edit.'));
        $account_split_item = AccountSplitItem::findOrFail($id);
        $company = Company::find(session('selected-company'));
        $chart_of_accounts = $company->chart_of_accounts;
        return view('v1.account-split-items.edit')
            ->with('account_split_item',$account_split_item)
            ->with('chart_of_accounts',$chart_of_accounts);
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
            return redirect()->route('account-split-items')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('unique_sub_account', function ($attribute, $value, $parameters, $validator) use ($request, $id){
            return AccountSplitItem::where('id','!=',$id)->where('account_no',$request->account_no)->where('sub_account_no',$request->sub_account_no)->where('sub_account_name',$request->sub_account_name)->count() ? false : true;
        });
        $validator = $request->validate([
            'account_no' => 'required|unique_sub_account',
            'sub_account_no' => 'required',
            'sub_account_name' => 'required|unique:account_split_items,sub_account_name,'.$id
        ],['unique_sub_account' => 'Item already existed']);

        $account_split_item = AccountSplitItem::findOrFail($id);
        $account_split_item->account_no = $request->account_no;
        $account_split_item->sub_account_no = $request->sub_account_no;
        $account_split_item->sub_account_name = $request->sub_account_name;
        $account_split_item->save();

        $response = 'Account Split Item Updated!';
        auth()->user()->store_activity('updated account split item - '.$account_split_item->sub_account_name);
        return redirect()->route('account-split-items')->with('status', trans($response));
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
            return redirect()->route('account-split-items')->with('status', trans('You don\'t have permission to delete.'));
        
        $account_split_item = AccountSplitItem::findOrFail($id);
        auth()->user()->store_activity('deleted account split item - '.$account_split_item->sub_account_name);
        $account_split_item->delete();
        $response = 'Account Split Item Deleted!';

        return redirect()->route('account-split-items')->with('status', trans($response));
    }
}
