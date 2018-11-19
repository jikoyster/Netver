<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CountryCurrency;
use App\StateProvince;
use App\GlobalCurrencyCode;
use Auth;

class CountryController extends Controller
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
        $countries = CountryCurrency::all();
        $global_currency_codes = GlobalCurrencyCode::distinct()->get(['alphabetic_code']);
        return view('v1.country.index')
            ->with('countries',$countries)
            ->with('global_currency_codes',$global_currency_codes);
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
        return view('v1.country.add');
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
            return redirect()->route('country')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'country_name' => 'required|unique:country_currencies,country_name',
            'currency_name' => 'required',
            'iso_code' => 'required|unique:country_currencies,iso_code',
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            'inactive' => ''
        ]);

        $country = new CountryCurrency;
        $country->country_name = $request->country_name;
        $country->currency_name = $request->currency_name;
        $country->iso_code = strtoupper($request->iso_code);
        $country->currency_code = strtoupper($request->currency_code);
        $country->currency_symbol = strtoupper($request->currency_symbol);
        $country->inactive = $request->inactive ? 1 : 0;
        $flag = $request->file('flag');
        if($flag) {
            $path = $flag->storeAs('public/country-flags',strtolower(str_replace(" ","-",$request->country_name)).'.'.$flag->getClientOriginalExtension());
            $country->flag = strtolower(str_replace(" ","-",$request->country_name)).'.'.$flag->getClientOriginalExtension();
        }
        $country->save();

        $response = 'New Country Added!';
        return redirect()->route('country')->with('status', trans($response));
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
    public function showStateProvince($id)
    {
        if($id)
            $country = CountryCurrency::findOrFail($id)->state_provinces;
        else
            $country = [];
        return $country;
    }
    public function showMapGroups($id = null)
    {
        if($id)
            $map_groups = CountryCurrency::findOrFail($id)->map_groups;
        else
            $map_groups = [];
        return $map_groups;
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
            return redirect()->route('country')->with('status', trans('You don\'t have permission to edit.'));
        $country = CountryCurrency::findOrFail($id);
        $global_currency_codes = GlobalCurrencyCode::distinct()->get(['alphabetic_code']);
        return view('v1.country.edit')
            ->with('country',$country)
            ->with('global_currency_codes',$global_currency_codes);
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
            return redirect()->route('country')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'country_name' => 'required|unique:country_currencies,country_name,'.$id,
            'currency_name' => 'required',
            'iso_code' => 'required|unique:country_currencies,iso_code,'.$id,
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            'inactive' => ''
        ]);

        $country = CountryCurrency::findOrFail($id);
        $country->country_name = $request->country_name;
        $country->currency_name = $request->currency_name;
        $country->iso_code = $request->iso_code;
        $country->currency_code = $request->currency_code;
        $country->currency_symbol = $request->currency_symbol;
        $country->inactive = $request->inactive ? 1 : 0;
        $flag = $request->file('flag');
        if($flag) {
            $path = $flag->storeAs('public/country-flags',strtolower(str_replace(" ","-",$request->country_name)).'.'.$flag->getClientOriginalExtension());
            $country->flag = strtolower(str_replace(" ","-",$request->country_name)).'.'.$flag->getClientOriginalExtension();
        }
        $country->save();

        $response = 'Country Updated!';
        return redirect()->route('country')->with('status', trans($response));
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
            return redirect()->route('country')->with('status', trans('You don\'t have permission to delete.'));
        $result = CountryCurrency::withCount('state_provinces')->findOrFail($id);
        if($result->state_provinces_count)
            $response = 'Country Used, Cannot be Deleted!';
        else {
            CountryCurrency::destroy($id);
            $response = 'Country Deleted!';
        }
        return redirect()->route('country')->with('status', trans($response));
    }

    public function stateProvinces($id)
    {
        return $state_provinces = StateProvince::where('country_currency_id',$id)->get();
    }
}
