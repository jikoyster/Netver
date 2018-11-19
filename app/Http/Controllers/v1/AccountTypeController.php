<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\AccountType;
use Auth;

class AccountTypeController extends Controller
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
        $account_types = AccountType::all();
        return view('v1.account-types.index')
            ->with('account_types',$account_types);
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
            return redirect()->route('account-types')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:account_types'
        ]);

        $account_type = new AccountType;
        $account_type->name = $request->name;
        $account_type->save();

        $response = 'New Account Type Added!';
        Auth::user()->store_activity('added account type - '.$account_type->name);
        return redirect()->route('account-types')->with('status', trans($response));
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
            return redirect()->route('account-types')->with('status', trans('You don\'t have permission to edit.'));
        $account_type = AccountType::findOrFail($id);
        return view('v1.account-types.edit')
            ->with('account_type',$account_type);
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
            return redirect()->route('account-types')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:account_types,name,'.$id
        ]);

        $account_type = AccountType::findOrFail($id);
        $account_type->name = $request->name;
        $account_type->save();

        $response = 'Account Type Updated!';
        Auth::user()->store_activity('updated account type - '.$account_type->name);
        return redirect()->route('account-types')->with('status', trans($response));
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
            return redirect()->route('account-types')->with('status', trans('You don\'t have permission to delete.'));
        
        $account_type = AccountType::findOrFail($id);
        Auth::user()->store_activity('deleted account type - '.$account_type->name);
        $account_type->delete();
        $response = 'Account Type Deleted!';

        return redirect()->route('account-types')->with('status', trans($response));
    }
}
