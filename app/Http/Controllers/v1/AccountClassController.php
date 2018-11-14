<?php

namespace App\Http\Controllers\v1;

use App\AccountClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AccountClassController extends Controller
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
        $account_classes = AccountClass::where('parent_id',null)->get();
        $account_classes = AccountClass::class_extractor($account_classes);
        $parent_classes = AccountClass::where('has_children',1)->get();
        return view('v1.account-classes.index')
            ->with('account_classes',$account_classes)
            ->with('parent_classes',$parent_classes);
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
            return redirect()->route('account-classes')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('code_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return AccountClass::where('parent_id',$request->parent_id)->where('code',$value)->where('name',$request->name)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required',
            'code' => 'required|code_unique'
        ],['code_unique'=>'Code and Name combination already existed.']);
        $account_class = new AccountClass;
        $account_class->code = $request->code;
        $account_class->name = $request->name;
        $account_class->parent_id = $request->parent_id;
        $account_class->has_children = $request->has_children ? 1 : 0;
        $account_class->save();
        $response = 'New Account Class Added';
        auth()->user()->store_activity('added account class - '.$account_class->name);
        return redirect()->route('account-classes')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountClass  $accountClass
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountClass  $accountClass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('account-classes')->with('status', trans('You don\'t have permission to edit.'));
        $account_class = AccountClass::findOrFail($id);
        $parent_classes = AccountClass::where('id','!=',$id)->where('has_children',1)->get();
        return view('v1.account-classes.edit')
            ->with('account_class',$account_class)
            ->with('parent_classes',$parent_classes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountClass  $accountClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('account-classes')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('code_unique', function ($attribute, $value, $parameters, $validator) use ($id, $request){
            return AccountClass::where('parent_id',$request->parent_id)->where('id','!=',$id)->where('code',$value)->where('name',$request->name)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required',
            'code' => 'required|code_unique'
        ],['code_unique'=>'Code and Name combination already existed.']);
        $account_class = AccountClass::findOrFail($id);
        AccountClass::where('parent_id',$id)->update(['parent_id'=>null]);
        if(strtolower($account_class->name) == strtolower($request->name))
            auth()->user()->store_activity('updated account class - '.$account_class->name);
        else
            auth()->user()->store_activity('updated account class - '.$account_class->name.' to '.$request->name);
        $account_class->code = $request->code;
        $account_class->name = $request->name;
        $account_class->parent_id = $request->parent_id;
        $account_class->has_children = $request->has_children ? 1 : 0;
        $account_class->save();
        $response = 'Account Class Updated';
        return redirect()->route('account-classes')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountClass  $accountClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('account-classes')->with('status', trans('You don\'t have permission to delete.'));
        $account_class = AccountClass::findOrFail($id);
        if($account_class->account_maps->count() || $account_class->gcoas->count())
            return redirect()->route('account-classes')->with('status','Account Class Used, Cannot be deleted.');
        AccountClass::where('parent_id',$id)->update(['parent_id'=>null]);
        auth()->user()->store_activity('deleted account class - '.$account_class->name);
        $account_class->delete();
        $response = 'Account Class Deleted';
        return redirect()->route('account-classes')->with('status',$response);
    }
}
