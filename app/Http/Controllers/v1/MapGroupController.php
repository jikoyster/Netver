<?php

namespace App\Http\Controllers\v1;

use App\MapGroup;
use App\CountryCurrency;
use App\NationalChartOfAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MapGroupController extends Controller
{
    public function index()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $map_groups = MapGroup::all();
        $countries = CountryCurrency::all();
        $ncas = NationalChartOfAccount::all();
        return view('v1.map-groups.index')
            ->with('map_groups',$map_groups)
            ->with('countries',$countries)
            ->with('ncas',$ncas);
    }

    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('map-groups')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('map_group_name_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return MapGroup::where('name',$value)->where('country_id',$request->country_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required|map_group_name_unique',
            'country_id' => 'required'
        ],['name.map_group_name_unique' => 'Group Name already Existed.']);
        $map_group = new MapGroup;
        $map_group->country_id = $request->country_id;
        $map_group->name = $request->name;
        $map_group->nca_id = $request->nca_id;
        $map_group->save();
        $response = 'New Map Group Added';
        auth()->user()->store_activity('added map group - '.$map_group->name);
        return redirect()->route('map-groups')->with('status',$response);
    }

    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('map-groups')->with('status', trans('You don\'t have permission to edit.'));
        $map_group = MapGroup::findOrFail($id);
        $nca_linked = $map_group->lists->where('nca','!=',null)->count();
        $countries = CountryCurrency::all();
        $ncas = NationalChartOfAccount::all();
        return view('v1.map-groups.edit')
            ->with('map_group',$map_group)
            ->with('nca_linked',$nca_linked)
            ->with('countries',$countries)
            ->with('ncas',$ncas);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('map-groups')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('map_group_name_unique', function ($attribute, $value, $parameters, $validator) use ($request, $id){
            return MapGroup::where('id','!=',$id)->where('name',$value)->where('country_id',$request->country_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'name' => 'required|map_group_name_unique',
            'country_id' => ''
        ],['name.map_group_name_unique' => 'Group Name already Existed.']);
        $map_group = MapGroup::findOrFail($id);
        if(strtolower($map_group->name) == strtolower($request->name))
            auth()->user()->store_activity('updated map group - '.$map_group->name);
        else
            auth()->user()->store_activity('updated map group - '.$map_group->name.' to '.$request->name);
        $map_group->name = $request->name;
        if($request->country_id)
            $map_group->country_id = $request->country_id;
        if($request->nca_id)
            $map_group->nca_id = $request->nca_id;
        $map_group->save();
        $response = 'Map Group Updated';
        return redirect()->route('map-groups')->with('status',$response);
    }

    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('map-groups')->with('status', trans('You don\'t have permission to delete.'));
        $map_group = MapGroup::findOrFail($id);
        if($map_group->lists->count() > 0 || $map_group->chart_of_account_groups->count() > 0)
            return redirect()->route('map-groups')->with('status','Map Group Used, cannot be deleted');
        auth()->user()->store_activity('deleted map group - '.$map_group->name);
        //$map_group->lists()->delete();
        $map_group->delete();
        $response = 'Map Group Deleted';
        return redirect()->route('map-groups')->with('status',$response);
    }
}
