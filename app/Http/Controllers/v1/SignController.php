<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sign;
use Auth;

class SignController extends Controller
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
        $signs = Sign::all();
        return view('v1.signs.index')
            ->with('signs',$signs);
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
            return redirect()->route('signs')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:signs'
        ]);

        $sign = new Sign;
        $sign->name = $request->name;
        $sign->save();

        $response = 'New Sign Added!';
        return redirect()->route('signs')->with('status', trans($response));
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
            return redirect()->route('signs')->with('status', trans('You don\'t have permission to edit.'));
        $sign = Sign::findOrFail($id);
        return view('v1.signs.edit')
            ->with('sign',$sign);
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
            return redirect()->route('signs')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:signs,name,'.$id
        ]);

        $sign = Sign::findOrFail($id);
        $sign->name = $request->name;
        $sign->save();

        $response = 'Sign Updated!';
        return redirect()->route('signs')->with('status', trans($response));
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
            return redirect()->route('signs')->with('status', trans('You don\'t have permission to delete.'));
        
        Sign::destroy($id);
        $response = 'Sign Deleted!';

        return redirect()->route('signs')->with('status', trans($response));
    }
}
