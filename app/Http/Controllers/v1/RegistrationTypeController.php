<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RegistrationType;
use Auth;

class RegistrationTypeController extends Controller
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
        $registration_types = RegistrationType::all();
        return view('v1.registration-types.index')
            ->with('registration_types',$registration_types);
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
            return redirect()->route('registration-types')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:registration_types'
        ]);

        $registration_type = new RegistrationType;
        $registration_type->name = $request->name;
        $registration_type->save();

        $response = 'New Registration Type Added!';
        return redirect()->route('registration-types')->with('status', trans($response));
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
            return redirect()->route('registration-types')->with('status', trans('You don\'t have permission to edit.'));
        $registration_type = RegistrationType::findOrFail($id);
        return view('v1.registration-types.edit')
            ->with('registration_type',$registration_type);
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
            return redirect()->route('registration-types')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:registration_types,name,'.$id
        ]);

        $registration_type = RegistrationType::findOrFail($id);
        $registration_type->name = $request->name;
        $registration_type->save();

        $response = 'Registration Type Updated!';
        return redirect()->route('registration-types')->with('status', trans($response));
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
            return redirect()->route('registration-types')->with('status', trans('You don\'t have permission to delete.'));
        $registration_type = RegistrationType::find($id);
        if(
            $registration_type->company_vendors->count() ||
            $registration_type->companies->count())
            return redirect()->route('registration-types')->with('status', trans('Registration type used, cannot be deleted.'));
        $registration_type->delete();
        $response = 'Registration Type Deleted!';

        return redirect()->route('registration-types')->with('status', trans($response));
    }
}
