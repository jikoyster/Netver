<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feature;
use Auth;

class FeatureController extends Controller
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
        $features = Feature::all();
        return view('v1.features.index')
            ->with('features',$features);
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
            return redirect()->route('features')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:features,name',
            'inactive' => ''
        ]);

        $feature = new Feature;
        $feature->name = $request->name;
        $feature->inactive = $request->inactive ? 1 : 0;
        $feature->save();

        auth()->user()->store_activity('added feature - '.$feature->name);
        $response = 'New Feature Added!';

        return redirect()->route('features')->with('status', trans($response));
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
            return redirect()->route('features')->with('status', trans('You don\'t have permission to edit.'));
        $feature = Feature::findOrFail($id);
        return view('v1.features.edit')
            ->with('feature',$feature);
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
            return redirect()->route('features')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:features,name,'.$id,
            'inactive' => ''
        ]);

        $feature = Feature::findOrFail($id);

        $response = 'Feature Updated!';
        auth()->user()->store_activity('updated feature - '.$feature->name.' to '.$request->name);

        $feature->name = $request->name;
        $feature->inactive = $request->inactive ? 1 : 0;
        $feature->save();

        return redirect()->route('features')->with('status', trans($response));
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
            return redirect()->route('features')->with('status', trans('You don\'t have permission to delete.'));
        $feature = Feature::find($id);

        $response = 'Feature Deleted!';
        auth()->user()->store_activity('deleted feature - '.$feature->name);

        $feature->delete();
        return redirect()->route('features')->with('status', trans($response));
    }
}
