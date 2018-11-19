<?php

namespace App\Http\Controllers\v1;

use App\Ledger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LedgerController extends Controller
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
        $ledgers = Ledger::all();
        return view('v1.ledgers.index')
            ->with('ledgers',$ledgers);
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
            return redirect()->route('ledgers')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:ledgers'
        ]);
        $ledger = new Ledger;
        $ledger->name = $request->name;
        $ledger->save();
        $response = 'New Ledger Added';
        auth()->user()->store_activity('added ledger - '.$ledger->name);
        return redirect()->route('ledgers')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ledger  $Ledger
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ledger  $Ledger
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('ledgers')->with('status', trans('You don\'t have permission to edit.'));
        $ledger = Ledger::findOrFail($id);
        return view('v1.ledgers.edit')
            ->with('ledger',$ledger);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ledger  $Ledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('ledgers')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:ledgers,name,'.$id
        ]);
        $ledger = Ledger::findOrFail($id);
        if(strtolower($ledger->name) == strtolower($request->name))
            auth()->user()->store_activity('updated ledger - '.$ledger->name);
        else
            auth()->user()->store_activity('updated ledger - '.$ledger->name.' to '.$request->name);
        $ledger->name = $request->name;
        $ledger->save();
        $response = 'Ledger Updated';
        return redirect()->route('ledgers')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ledger  $Ledger
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('ledgers')->with('status', trans('You don\'t have permission to delete.'));
        $ledger = Ledger::findOrFail($id);
        auth()->user()->store_activity('deleted ledger - '.$ledger->name);
        $ledger->delete();
        $response = 'Ledger Deleted';
        return redirect()->route('ledgers')->with('status',$response);
    }
}
