<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GlobalCurrencyCode;

class GlobalCurrencyCodeController extends Controller
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
        $global_currency_codes = GlobalCurrencyCode::all();
        return view('v1.global-currency-codes.index')
            ->with('global_currency_codes',$global_currency_codes);
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
            return redirect()->route('global-currency-codes')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'entity' => 'required|unique:global_currency_codes',
            'currency' => 'required|unique:global_currency_codes',
            'alphabetic_code' => 'required|unique:global_currency_codes',
            'numeric_code' => 'required|unique:global_currency_codes'
        ]);
        $global_currency_code = new GlobalCurrencyCode;
        $global_currency_code->entity = $request->entity;
        $global_currency_code->currency = $request->currency;
        $global_currency_code->alphabetic_code = $request->alphabetic_code;
        $global_currency_code->numeric_code = $request->numeric_code;
        $global_currency_code->active = $request->active ? 1 : 0;
        $global_currency_code->save();
        $response = 'New Global Currency Code Added';
        auth()->user()->store_activity('added global currency code - '.$global_currency_code->name);
        return redirect()->route('global-currency-codes')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        return $id ? GlobalCurrencyCode::findOrFail($id) : '';
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
            return redirect()->route('global-currency-codes')->with('status', trans('You don\'t have permission to edit.'));
        $global_currency_code = GlobalCurrencyCode::findOrFail($id);
        return view('v1.global-currency-codes.edit')
            ->with('global_currency_code',$global_currency_code);
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
            return redirect()->route('global-currency-codes')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'entity' => 'required|unique:global_currency_codes,entity,'.$id,
            'currency' => 'required|unique:global_currency_codes,currency,'.$id,
            'alphabetic_code' => 'required|unique:global_currency_codes,alphabetic_code,'.$id,
            'numeric_code' => 'required|unique:global_currency_codes,numeric_code,'.$id
        ]);
        $global_currency_code = GlobalCurrencyCode::findOrFail($id);
        if(strtolower($global_currency_code->name) == strtolower($request->name))
            auth()->user()->store_activity('updated global currency code - '.$global_currency_code->name);
        else
            auth()->user()->store_activity('updated global currency code - '.$global_currency_code->name.' to '.$request->name);
        $global_currency_code->entity = $request->entity;
        $global_currency_code->currency = $request->currency;
        $global_currency_code->alphabetic_code = $request->alphabetic_code;
        $global_currency_code->numeric_code = $request->numeric_code;
        $global_currency_code->active = $request->active ? 1 : 0;
        $global_currency_code->save();
        $response = 'Global Currency Code Updated';
        return redirect()->route('global-currency-codes')->with('status',$response);
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
            return redirect()->route('global-currency-codes')->with('status', trans('You don\'t have permission to delete.'));
        $global_currency_code = GlobalCurrencyCode::findOrFail($id);
        if(
            $global_currency_code->company_vendors->count()
            || $global_currency_code->company_chart_of_accounts->count())
            return redirect()->route('global-currency-codes')->with('status', trans('Currency used, cannot be deleted.'));
        auth()->user()->store_activity('deleted global currency code - '.$global_currency_code->name);
        $global_currency_code->delete();
        $response = 'Global Currency Code Deleted';
        return redirect()->route('global-currency-codes')->with('status',$response);
    }
}
