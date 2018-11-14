<?php

namespace App\Http\Controllers\v1;

use App\CompanyAccountMap;
use App\Company;
use App\MapGroup;
use App\MapGroupList;
use App\CountryCurrency;
use App\NationalChartOfAccount;
use App\AccountClass;
use App\AccountGroup;
use App\Sign;
use App\AccountMap;
use App\AccountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyAccountMapController extends Controller
{
    public function index($id = null)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company = Company::findOrFail(session('selected-company'));
        $company_account_maps = $company->account_maps;
        $parent_maps = AccountMap::where('has_a_child',1)->get()->sortBy('map_no');
        $account_types = AccountType::all();
        $signs = Sign::all();
        $account_classes = AccountClass::all();
        $account_groups = AccountGroup::all();
        $flip_tos = AccountMap::where('parent_id',null)->where('title',0)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $flip_tos = AccountMap::class_extractor($flip_tos);
        $ncas = NationalChartOfAccount::where('country_id',$company->country)->first();
        return view('v1.company-account-maps.index')
            ->with('company',$company)
            ->with('company_account_maps',$company_account_maps)
            ->with('parent_maps',$parent_maps)
            ->with('account_types',$account_types)
            ->with('signs',$signs)
            ->with('account_classes',$account_classes)
            ->with('account_groups',$account_groups)
            ->with('flip_tos',$flip_tos)
            ->with('ncas',$ncas);
    }

    public function create()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('add'))
            return redirect()->route('company-account-maps')->with('status', trans('You don\'t have permission to add.'));
        $company = Company::findOrFail(session('selected-company'));
        $group_sources = MapGroup::where('country_id',$company->country)->get();
        return view('v1.company-account-maps.import')
            ->with('group_sources',$group_sources);
    }

    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('company-account-maps')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('map_no_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return CompanyAccountMap::where('map_no',$value)->where('parent_id',$request->parent_id)->count() ? false : true;
        });
        $validator = $request->validate([
            'map_no' => 'required|integer|map_no_unique',
            'title' => '',
            'unassignable' => '',
            'name' => 'required',
            'parent_id' => '',
            'account_type_id' => 'required',
            'sign_id' => 'required',
            'account_class_id' => '',
            'account_group_id' => '',
            'flip_type' => '',
            'flip_to' => 'required_if:flip_type,value,Individual,Total is Debit,Total is Credit',
            'has_a_child' => '',
        ],['map_no_unique' => 'Map No. already existed.']);
        $account_map = new CompanyAccountMap;
        $account_map->company_id = session('selected-company');
        $account_map->map_no = $request->map_no;
        $account_map->name = $request->name;
        $account_map->nca = $request->nca;
        /*$account_map->parent_id = $request->parent_id;*/
        $account_map->title = $request->title ? 1 : 0;
        $account_map->unassignable = $request->unassignable ? 1 : 0;
        $account_map->flip_type = $request->flip_type ?: '';
        $account_map->flip_to = $request->flip_to;
        $account_map->type = $request->account_type_id;
        $account_map->sign = $request->sign_id;
        $account_map->class = $request->account_class_id;
        $account_map->group = $request->account_group_id;
        /*$account_map->has_a_child = $request->has_a_child ? 1 : 0;*/
        $account_map->save();
        $response = 'New Company Account Map Added';
        auth()->user()->store_activity('added company account map - '.$account_map->name);
        return redirect()->route('company-account-maps')->with('status',$response);
    }

    public function import(Request $request)
    {
    	//return $request;
        if(!auth()->user()->can('add'))
            return redirect()->route('company-account-maps')->with('status', trans('You don\'t have permission to add.'));
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
                    if(CompanyAccountMap::where('company_id',session('selected-company'))->where('map_no',$gcoa->id)->count() < 1) {
                        $map_group_list = new CompanyAccountMap;
                        $map_group_list->company_id = session('selected-company');
                        $map_group_list->map_group_id = $gcoa->map_group_id;
                        $map_group_list->map_no = $gcoa->map_no;
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
                        auth()->user()->store_activity('added company account map - '.$map_group_list->name);
                        $response[] = 'Added '.$gcoa->map_no.'-'.$gcoa->name;
                    } else {
                        $response[] = $gcoa->map_no.'-'.$gcoa->name.' already added';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('company-account-maps')->with('status',$response);
    }

    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-account-maps')->with('status', trans('You don\'t have permission to edit.'));
        $company = Company::findOrFail(session('selected-company'));
        $company_account_map = CompanyAccountMap::findOrFail($id);
        $classes = AccountClass::all();
        $groups = AccountGroup::all();
        $maps = AccountMap::where('parent_id',null)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $maps = AccountMap::class_extractor($maps);
        $flip_tos = AccountMap::where('parent_id',null)->where('title',0)->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $flip_tos = AccountMap::class_extractor($flip_tos);
        $signs = Sign::all();
        $account_types = AccountType::all();
        $ncas = NationalChartOfAccount::where('country_id',$company->country)->first();
        return view('v1.company-account-maps.edit')
            ->with('company_account_map',$company_account_map)
            ->with('classes',$classes)
            ->with('groups',$groups)
            ->with('maps',$maps)
            ->with('flip_tos',$flip_tos)
            ->with('signs',$signs)
            ->with('account_types',$account_types)
            ->with('ncas',$ncas);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-account-maps')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        $map_group_list = CompanyAccountMap::findOrFail($id);
        if(strtolower($map_group_list->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company account map - '.$map_group_list->name);
        else
            auth()->user()->store_activity('updated company account map - '.$map_group_list->name.' to '.$request->name);
        $map_group_list->map_group_id = null;
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
        return redirect()->route('company-account-maps')->with('status',$response);
    }

    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-account-maps')->with('status', trans('You don\'t have permission to delete.'));
        $map_group_list = CompanyAccountMap::findOrFail($id);
        auth()->user()->store_activity('deleted company account map - '.$map_group_list->name);
        $map_group_list->delete();
        $response = 'Deleted';
        return redirect()->route('company-account-maps')->with('status',$response);
    }

    public function groupSource(Request $request)
    {
        if($request->group_source_id) {
            if($request->group_source_id == 'company_account_maps') {
                $load = ['parent_map','account_type','normal_sign','account_class','account_group','flip_to_map'=>function($query){
                    $query->with('parent_map');
                }];
                $test = CompanyAccountMap::where('company_id',session('selected-company'));
            } else {
                $load = ['parent_map','account_type','normal_sign','account_class','account_group','flip_to_map'=>function($query){
                    $query->with('parent_map');
                },'account_map'];
                $test = MapGroupList::where('map_group_id',$request->group_source_id)->whereNotIn('map_no',CompanyAccountMap::where('company_id',session('selected-company'))->pluck('map_no'));
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
