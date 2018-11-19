<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CountryCurrency;
use App\StateProvince;
use Auth;
use Illuminate\Support\Facades\Validator;

class StateCountryController extends Controller
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
        $states = StateProvince::with('country')->get();
        $countries = CountryCurrency::all();
        return view('v1.state-province.index')
            ->with('countries',$countries)
            ->with('states',$states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        $countries = CountryCurrency::all();
        return view('v1.state-province.add')
            ->with('countries',$countries);
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
            return redirect()->route('state-province')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('state_province_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return StateProvince::where('country_currency_id',$request->country_currency_id)->where('state_province_name',$value)->count() ? false : true;
        });
        $validator = $request->validate([
            'country_currency_id' => 'required',
            'state_province_name' => 'required|state_province_unique',
            'inactive' => ''
        ],['state_province_unique' => 'Already Existed.']);

        $state = new StateProvince;
        $state->country_currency_id = $request->country_currency_id;
        $state->state_province_name = $request->state_province_name;
        $state->inactive = $request->inactive ? 1 : 0;
        $flag = $request->file('flag');
        if($flag) {
            $path = $flag->storeAs('public/state-province-flags',strtolower(str_replace(" ","-",$request->state_province_name)).'.'.$flag->getClientOriginalExtension());
            $state->flag = strtolower(str_replace(" ","-",$request->state_province_name)).'.'.$flag->getClientOriginalExtension();
        }
        $state->save();

        $response = 'New State Added!';
        return redirect()->route('state-province')->with('status', trans($response));
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
            return redirect()->route('state-province')->with('status', trans('You don\'t have permission to edit.'));
        $countries = CountryCurrency::all();
        $state_province = StateProvince::findOrFail($id);
        return view('v1.state-province.edit')
            ->with('countries',$countries)
            ->with('state_province',$state_province);
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
            return redirect()->route('state-province')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('state_province_unique', function ($attribute, $value, $parameters, $validator) use ($id, $request){
            return StateProvince::where('id','!=',$id)->where('country_currency_id',$request->country_currency_id)->where('state_province_name',$value)->count() ? false : true;
        });
        $validator = $request->validate([
            'country_currency_id' => 'required',
            'state_province_name' => 'required|state_province_unique',
            'inactive' => ''
        ],['state_province_unique' => 'Already Existed.']);

        $state = StateProvince::findOrFail($id);
        $state->country_currency_id = $request->country_currency_id;
        $state->state_province_name = $request->state_province_name;
        $state->inactive = $request->inactive ? 1 : 0;
        $flag = $request->file('flag');
        if($flag) {
            $path = $flag->storeAs('public/state-province-flags',strtolower(str_replace(" ","-",$request->state_province_name)).'.'.$flag->getClientOriginalExtension());
            $state->flag = strtolower(str_replace(" ","-",$request->state_province_name)).'.'.$flag->getClientOriginalExtension();
        }
        $state->save();

        $response = 'State / Province Updated!';
        return redirect()->route('state-province')->with('status', trans($response));
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
            return redirect()->route('state-province')->with('status', trans('You don\'t have permission to delete.'));
        $result = StateProvince::withCount('addresses')->findOrFail($id);
        if($result->addresses_count)
            $response = 'State/Province Used, Cannot be Deleted!';
        else {
            StateProvince::destroy($id);
            $response = 'State/Province Deleted!';
        }
        return redirect()->route('state-province')->with('status', trans($response));
    }
}
