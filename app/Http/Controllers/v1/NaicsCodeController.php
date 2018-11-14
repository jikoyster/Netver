<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NaicsCode;

class NaicsCodeController extends Controller
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
        $naics_codes = NaicsCode::all();
        return view('v1.naics-codes.index')
            ->with('naics_codes',$naics_codes);
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
            return redirect()->route('naics-codes')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'code' => 'required|integer|unique:naics_codes',
            'name' => 'required|unique:naics_codes',
            'description' => 'required'
        ]);
        $naics_code = new NaicsCode;
        $naics_code->code = $request->code;
        $naics_code->name = $request->name;
        $naics_code->description = $request->description;
        $naics_code->save();
        $response = 'New Naic Code Added';
        auth()->user()->store_activity('added naic code - '.$naics_code->name);
        return redirect()->route('naics-codes')->with('status',$response);
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
            return redirect()->route('naics-codes')->with('status', trans('You don\'t have permission to edit.'));
        $naics_code = NaicsCode::findOrFail($id);
        return view('v1.naics-codes.edit')
            ->with('naics_code',$naics_code);
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
            return redirect()->route('naics-codes')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:naics_codes,name,'.$id,
            'code' => 'required|integer|unique:naics_codes,code,'.$id,
            'description' => 'required'
        ]);
        $naics_code = NaicsCode::findOrFail($id);
        if(strtolower($naics_code->name) == strtolower($request->name))
            auth()->user()->store_activity('updated naic code - '.$naics_code->name);
        else
            auth()->user()->store_activity('updated naic code - '.$naics_code->name.' to '.$request->name);
        $naics_code->code = $request->code;
        $naics_code->name = $request->name;
        $naics_code->description = $request->description;
        $naics_code->save();
        $response = 'Naic Code Updated';
        return redirect()->route('naics-codes')->with('status',$response);
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
            return redirect()->route('naics-codes')->with('status', trans('You don\'t have permission to delete.'));
        $naics_code = NaicsCode::findOrFail($id);
        auth()->user()->store_activity('deleted naic code - '.$naics_code->name);
        $naics_code->delete();
        $response = 'Naic Code Deleted';
        return redirect()->route('naics-codes')->with('status',$response);
    }
}
