<?php

namespace App\Http\Controllers\v1;

use App\ChartOfAccountGroup;
use App\CountryCurrency;
use App\NationalChartOfAccount;
use App\MapGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChartOfAccountGroupController extends Controller
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
        $chart_of_account_groups = ChartOfAccountGroup::all();
        $countries = CountryCurrency::all();
        $map_groups = MapGroup::all();
        return view('v1.chart-of-account-groups.index')
            ->with('chart_of_account_groups',$chart_of_account_groups)
            ->with('countries',$countries)
            ->with('map_groups',$map_groups);
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
            return redirect()->route('chart-of-account-groups')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('coag_name_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return ChartOfAccountGroup::where('name',$value)->where('country_id',$request->country_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required|coag_name_unique',
            'country_id' => 'required',
            'map_group_id' => 'required'
        ],['name.coag_name_unique' => 'Group Name already Existed.']);
        $chart_of_account_group = new ChartOfAccountGroup;
        $chart_of_account_group->country_id = $request->country_id;
        $chart_of_account_group->name = $request->name;
        $chart_of_account_group->map_group_id = $request->map_group_id;
        $chart_of_account_group->save();
        $response = 'New Chart Of Account Group Added';
        auth()->user()->store_activity('added chart of account group - '.$chart_of_account_group->name);
        return redirect()->route('chart-of-account-groups')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChartOfAccountGroup  $chartOfAccountGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChartOfAccountGroup  $chartOfAccountGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('chart-of-account-groups')->with('status', trans('You don\'t have permission to edit.'));
        $chart_of_account_group = ChartOfAccountGroup::findOrFail($id);
        $countries = CountryCurrency::all();
        $map_groups = MapGroup::where('country_id',$chart_of_account_group->id)->get();
        return view('v1.chart-of-account-groups.edit')
            ->with('chart_of_account_group',$chart_of_account_group)
            ->with('countries',$countries)
            ->with('map_groups',$map_groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChartOfAccountGroup  $chartOfAccountGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('chart-of-account-groups')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('coag_name_unique', function ($attribute, $value, $parameters, $validator) use ($request, $id){
            return ChartOfAccountGroup::where('id','!=',$id)->where('name',$value)->where('country_id',$request->country_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required|coag_name_unique',
            'country_id' => 'required',
            'map_group_id' => 'required'
        ],['name.coag_name_unique' => 'Group Name already Existed.']);
        $chart_of_account_group = ChartOfAccountGroup::findOrFail($id);
        if(strtolower($chart_of_account_group->name) == strtolower($request->name))
            auth()->user()->store_activity('updated chart of account group - '.$chart_of_account_group->name);
        else
            auth()->user()->store_activity('updated chart of account group - '.$chart_of_account_group->name.' to '.$request->name);
        $chart_of_account_group->country_id = $request->country_id;
        $chart_of_account_group->name = $request->name;
        $chart_of_account_group->map_group_id = $request->map_group_id;
        $chart_of_account_group->save();
        $response = 'Chart Of Account Group Updated';
        return redirect()->route('chart-of-account-groups')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChartOfAccountGroup  $chartOfAccountGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('chart-of-account-groups')->with('status', trans('You don\'t have permission to delete.'));
        $chart_of_account_group = ChartOfAccountGroup::findOrFail($id);
        auth()->user()->store_activity('deleted chart of account group - '.$chart_of_account_group->name);
        $chart_of_account_group->lists()->delete();
        $chart_of_account_group->delete();
        $response = 'Chart Of Account Group Deleted';
        return redirect()->route('chart-of-account-groups')->with('status',$response);
    }
}
