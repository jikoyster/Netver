<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Designation;
use Auth;

class DesignationController extends Controller
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
        $designations = Designation::all();
        return view('v1.designations.index')
            ->with('designations',$designations);
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
            return redirect()->route('designations')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:designations'
        ]);

        $designation = new Designation;
        $designation->name = $request->name;
        $designation->save();

        $response = 'New Designation Added!';
        return redirect()->route('designations')->with('status', trans($response));
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
            return redirect()->route('designations')->with('status', trans('You don\'t have permission to edit.'));
        $designation = Designation::findOrFail($id);
        return view('v1.designations.edit')
            ->with('designation',$designation);
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
            return redirect()->route('designations')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:designations,name,'.$id
        ]);

        $designation = Designation::findOrFail($id);
        $designation->name = $request->name;
        $designation->save();

        $response = 'Designation Updated!';
        return redirect()->route('designations')->with('status', trans($response));
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
            return redirect()->route('designations')->with('status', trans('You don\'t have permission to delete.'));
        
        Designation::destroy($id);
        $response = 'Designation Deleted!';

        return redirect()->route('designations')->with('status', trans($response));
    }
}
