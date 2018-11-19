<?php

namespace App\Http\Controllers\v1;

use App\ChartOfAccountGroupList;
use App\ChartOfAccountGroup;
use App\CountryCurrency;
use App\GlobalChartOfAccount;
use App\AccountClass;
use App\AccountGroup;
use App\Sign;
use App\AccountMap;
use App\AccountType;
use App\NationalChartOfAccount;
use App\MapGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartOfAccountGroupListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $chart_of_account_group = ChartOfAccountGroup::findOrFail($id);
        $chart_of_account_group_lists = $chart_of_account_group->lists;
        $countries = CountryCurrency::all();
        return view('v1.chart-of-account-group-lists.index')
            ->with('chart_of_account_group',$chart_of_account_group)
            ->with('chart_of_account_group_lists',$chart_of_account_group_lists)
            ->with('countries',$countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('chart-of-account-group-lists')->with('status', trans('You don\'t have permission to add.'));
        $chart_of_account_group = ChartOfAccountGroup::findOrFail($id);
        $group_sources = ChartOfAccountGroup::where('id','!=',$id)->get();
        $countries = CountryCurrency::all();
        $map_groups = MapGroup::all();
        return view('v1.chart-of-account-group-lists.add')
            ->with('chart_of_account_group',$chart_of_account_group)
            ->with('countries',$countries)
            ->with('group_sources',$group_sources)
            ->with('map_groups',$map_groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$coag_id)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('chart-of-account-group-lists')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required',
            'group_source' => 'required'
        ]);
        if($request->group_source == 'global_chart_of_accounts') {
            $test = new GlobalChartOfAccount;
            $account_map_no_id = 'account_map_no';
            $normal_sign = 'sign_id';
        } else {
            $test = new ChartOfAccountGroupList;
            $account_map_no_id = 'account_map_no_id';
            $normal_sign = 'normal_sign';
        }
        if($request->gcoa_ids) {
            foreach($request->gcoa_ids as $id) {
                if($id != 'all') {
                    $gcoa = $test::findOrFail($id);
                    if(ChartOfAccountGroupList::where('coag_id',$coag_id)->where('account_no',$gcoa->account_no)->count() < 1) {
                        $chart_of_account_group_list = new ChartOfAccountGroupList;
                        $chart_of_account_group_list->coag_id = $coag_id;
                        $chart_of_account_group_list->account_no = $gcoa->account_no;
                        $chart_of_account_group_list->name = $gcoa->name;
                        $chart_of_account_group_list->account_map_no_id = $gcoa->$account_map_no_id;
                        $chart_of_account_group_list->account_type_id = $gcoa->account_type_id;
                        $chart_of_account_group_list->normal_sign = $gcoa->$normal_sign;
                        $chart_of_account_group_list->account_group_id = $gcoa->account_group_id;
                        $chart_of_account_group_list->account_class_id = $gcoa->account_class_id;
                        /*if($gcoa->nca)
                            $chart_of_account_group_list->nca = $gcoa->nca;*/
                        $chart_of_account_group_list->save();
                        auth()->user()->store_activity('added chart of account group list - '.$chart_of_account_group_list->name);
                        $response[] = 'Added '.$gcoa->account_no.'-'.$gcoa->name;
                    } else {
                        $response[] = $gcoa->account_no.'-'.$gcoa->name.' already added';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('chart-of-account-group-lists',[$coag_id])->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChartOfAccountGroupList  $chartOfAccountGroupList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChartOfAccountGroupList  $chartOfAccountGroupList
     * @return \Illuminate\Http\Response
     */
    public function edit($coag_id,$id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('chart-of-account-group-lists')->with('status', trans('You don\'t have permission to edit.'));
        $chart_of_account_group = ChartOfAccountGroup::findOrFail($coag_id);
        $chart_of_account_group_list = ChartOfAccountGroupList::findOrFail($id);
        $countries = CountryCurrency::all();
        $classes = AccountClass::all();
        $groups = AccountGroup::all();
        $maps = AccountMap::where('parent_id',null)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $maps = AccountMap::class_extractor($maps);
        $signs = Sign::all();
        $account_types = AccountType::all();
        $map_groups = MapGroup::all();
        return view('v1.chart-of-account-group-lists.edit')
            ->with('chart_of_account_group',$chart_of_account_group)
            ->with('chart_of_account_group_list',$chart_of_account_group_list)
            ->with('classes',$classes)
            ->with('groups',$groups)
            ->with('maps',$maps)
            ->with('signs',$signs)
            ->with('account_types',$account_types)
            ->with('map_groups',$map_groups)
            ->with('countries',$countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChartOfAccountGroupList  $chartOfAccountGroupList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $coag_id, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('chart-of-account-group-lists')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        $chart_of_account_group_list = ChartOfAccountGroupList::findOrFail($id);
        if(strtolower($chart_of_account_group_list->name) == strtolower($request->name))
            auth()->user()->store_activity('updated chart of account group list - '.$chart_of_account_group_list->name);
        else
            auth()->user()->store_activity('updated chart of account group list - '.$chart_of_account_group_list->name.' to '.$request->name);
        $chart_of_account_group_list->account_no = $request->account_no;
        $chart_of_account_group_list->name = $request->name;
        $chart_of_account_group_list->account_map_no_id = $request->account_map_no_id;
        $chart_of_account_group_list->account_type_id = $request->account_type_id;
        /*$chart_of_account_group_list->nca = $request->nca;*/
        $chart_of_account_group_list->normal_sign = $request->normal_sign;
        $chart_of_account_group_list->account_group_id = $request->account_group_id;
        $chart_of_account_group_list->account_class_id = $request->account_class_id;
        $chart_of_account_group_list->save();
        $response = 'Updated';
        return redirect()->route('chart-of-account-group-lists',[$coag_id])->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChartOfAccountGroupList  $chartOfAccountGroupList
     * @return \Illuminate\Http\Response
     */
    public function destroy($coag_id, $id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('chart-of-account-group-lists')->with('status', trans('You don\'t have permission to delete.'));
        $chart_of_account_group_list = ChartOfAccountGroupList::findOrFail($id);
        auth()->user()->store_activity('deleted chart of account group list - '.$chart_of_account_group_list->name);
        $chart_of_account_group_list->delete();
        $response = 'Deleted';
        return redirect()->route('chart-of-account-group-lists',[$coag_id])->with('status',$response);
    }

    public function groupSource(Request $request)
    {
        if($request->group_source_id) {
            if($request->group_source_id == 'global_chart_of_accounts') {
                $normal_sign = 'normal_sign';
                $load = ['account_map'=>function($query){
                    $query->with('parent_map');
                },'account_type',$normal_sign,'account_group','account_class'];
                $test = new GlobalChartOfAccount;
            } else {
                $normal_sign = 'sign';
                $load = ['account_map'=>function($query){
                    $query->with('parent_map');
                },'account_type',$normal_sign,'account_group','account_class','national_chart_of_account_list'=>function($query){
                    $query->with('nca');
                }];
                $test = ChartOfAccountGroupList::where('coag_id',$request->group_source_id);
            }

            if($request->searchPhrase) {
                $gcoas = $test->where('account_no','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get()->load($load);
                $count = $test->where('account_no','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->count();
            } else {
                $gcoas = $test->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get()->load($load);
                $count = $test->count();
            }

            $request['rows'] = $gcoas;
            $request['total'] = $count;
        } else {
            $request['rows'] = [];
        }
        return $request;
    }
}
