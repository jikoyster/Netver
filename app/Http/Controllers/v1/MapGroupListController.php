<?php

namespace App\Http\Controllers\v1;

use App\MapGroupList;
use App\MapGroup;
use App\CountryCurrency;
use App\NationalChartOfAccount;
use App\AccountClass;
use App\AccountGroup;
use App\Sign;
use App\AccountMap;
use App\AccountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapGroupListController extends Controller
{
    public function index($id = null)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $map_group = MapGroup::findOrFail($id);
        $map_group_lists = $map_group->lists;
        $countries = CountryCurrency::all();
        return view('v1.map-group-lists.index')
            ->with('map_group',$map_group)
            ->with('map_group_lists',$map_group_lists)
            ->with('countries',$countries);
    }

    public function create($id = null)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('map-group-lists')->with('status', trans('You don\'t have permission to add.'));
        $map_group = MapGroup::findOrFail($id);
        $group_sources = MapGroup::where('id','!=',$id)->get();
        $countries = CountryCurrency::all();
        return view('v1.map-group-lists.add')
            ->with('map_group',$map_group)
            ->with('countries',$countries)
            ->with('group_sources',$group_sources);
    }

    public function store(Request $request,$map_group_id)
    {
    	//return $request;
        if(!auth()->user()->can('add'))
            return redirect()->route('map-group-lists')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required',
            'group_source' => 'required'
        ]);
        if($request->group_source == 'account_maps') {
            $test = new AccountMap;
            $normal_sign = 'sign_id';
            $type = 'account_type_id';
            $class = 'account_class_id';
            $group = 'account_group_id';
        } else {
            $test = new MapGroupList;
            $normal_sign = 'sign';
            $type = 'type';
            $class = 'class';
            $group = 'group';
        }
        if($request->account_map_ids) {
            foreach($request->account_map_ids as $id) {
                if($id != 'all') {
                    $gcoa = $test::findOrFail($id);
                    if(MapGroupList::where('map_group_id',$map_group_id)->where('map_no',$gcoa->id)->count() < 1) {
                        $map_group_list = new MapGroupList;
                        $map_group_list->map_group_id = $map_group_id;
                        $map_group_list->map_no = $gcoa->id;
                        $map_group_list->name = $gcoa->name;
                        $map_group_list->parent_id = $gcoa->parent_id;
                        $map_group_list->title = $gcoa->title ? 1:0;
                        $map_group_list->unassignable = $gcoa->unassignable ? 1:0;
                        $map_group_list->flip_type = $gcoa->flip_type;
                        $map_group_list->flip_to = $gcoa->flip_to;
                        $map_group_list->type = $gcoa->$type;
                        $map_group_list->sign = $gcoa->$normal_sign;
                        $map_group_list->class = $gcoa->$class;
                        $map_group_list->group = $gcoa->$group;
                        if($gcoa->nca)
                            $map_group_list->nca = $gcoa->nca;
                        $map_group_list->save();
                        auth()->user()->store_activity('added map group list - '.$map_group_list->name);
                        $response[] = 'Added '.$gcoa->map_no.'-'.$gcoa->name;
                    } else {
                        $response[] = $gcoa->map_no.'-'.$gcoa->name.' already added';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('map-group-lists',[$map_group_id])->with('status',$response);
    }

    public function edit($map_group_id,$id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('map-group-lists')->with('status', trans('You don\'t have permission to edit.'));
        $map_group = MapGroup::findOrFail($map_group_id);
        $map_group_list = MapGroupList::findOrFail($id);
        $countries = CountryCurrency::all();
        $classes = AccountClass::all();
        $groups = AccountGroup::all();
        $maps = AccountMap::where('parent_id',null)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $maps = AccountMap::class_extractor($maps);
        $flip_tos = AccountMap::where('parent_id',null)->where('title',0)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $flip_tos = AccountMap::class_extractor($flip_tos);
        $signs = Sign::all();
        $account_types = AccountType::all();
        $ncas = NationalChartOfAccount::all();
        return view('v1.map-group-lists.edit')
            ->with('map_group',$map_group)
            ->with('map_group_list',$map_group_list)
            ->with('classes',$classes)
            ->with('groups',$groups)
            ->with('maps',$maps)
            ->with('flip_tos',$flip_tos)
            ->with('signs',$signs)
            ->with('account_types',$account_types)
            ->with('ncas',$ncas)
            ->with('countries',$countries);
    }

    public function update(Request $request, $map_group_id, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('map-group-lists')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        $map_group_list = MapGroupList::findOrFail($id);
        if(strtolower($map_group_list->name) == strtolower($request->name))
            auth()->user()->store_activity('updated map group list - '.$map_group_list->name);
        else
            auth()->user()->store_activity('updated map group list - '.$map_group_list->name.' to '.$request->name);
        $map_group_list->map_no = $request->map_no;
        $map_group_list->name = $request->name;
        $map_group_list->nca = $request->nca;
        $map_group_list->title = $request->title ? 1:0;
        $map_group_list->unassignable = $request->unassignable ? 1:0;
        $map_group_list->flip_type = $request->flip_type;
        $map_group_list->flip_to = $request->flip_to;
        $map_group_list->type = $request->type;
        $map_group_list->sign = $request->sign;
        $map_group_list->class = $request->class;
        $map_group_list->group = $request->group;
        $map_group_list->save();
        $response = 'Updated Map Group List';
        return redirect()->route('map-group-lists',[$map_group_id])->with('status',$response);
    }

    public function destroy($map_group_id, $id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('map-group-lists')->with('status', trans('You don\'t have permission to delete.'));
        $map_group_list = MapGroupList::findOrFail($id);
        auth()->user()->store_activity('deleted map group list - '.$map_group_list->name);
        $map_group_list->delete();
        $response = 'Deleted';
        return redirect()->route('map-group-lists',[$map_group_id])->with('status',$response);
    }

    public function groupSource(Request $request)
    {
        if($request->group_source_id) {
            if($request->group_source_id == 'account_maps') {
                $load = ['parent_map','account_type','normal_sign','account_class','account_group','flip_to_map'=>function($query){
                    $query->with('parent_map');
                }];
                $test = new AccountMap;
            } else {
                $load = ['parent_map','account_type','normal_sign','account_class','account_group','flip_to_map'=>function($query){
                    $query->with('parent_map');
                },'account_map'];/*['account_map'=>function($query){
                    $query->with('parent_map');
                },'account_type',$normal_sign,'account_class','national_chart_of_account_list'=>function($query){
                    $query->with('nca');
                }];*/
                $test = MapGroupList::where('map_group_id',$request->group_source_id);
            }

            if($request->searchPhrase) {
                $gcoas = $test->where('map_no','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get()->load($load);
                $count = $test->where('map_no','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->count();
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
