<?php

namespace App\Http\Controllers\v1;

use App\CompanyChartOfAccount;
use App\Company;
use App\ChartOfAccountGroup;
use App\ChartOfAccountGroupList;
use App\CountryCurrency;
use App\GlobalChartOfAccount;
use App\AccountClass;
use App\AccountGroup;
use App\Sign;
use App\CompanyAccountMap;
use App\AccountType;
use App\NationalChartOfAccount;
use App\MapGroup;
use App\GlobalCurrencyCode;
use App\CompanySalesTax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyChartOfAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company = Company::findOrFail(session('selected-company'));
        $company_chart_of_accounts = $company->chart_of_accounts;
        $account_types = AccountType::all();
        $signs = Sign::all();
        $account_groups = AccountGroup::all();
        $account_classes = AccountClass::all();
        $maps = CompanyAccountMap::where('company_id',session('selected-company'))->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        $global_currency_codes = GlobalCurrencyCode::all();
        $company_tax_accounts = CompanySalesTax::where('company_id',session('selected-company'))->get();
        return view('v1.company-chart-of-accounts.index')
            ->with('company',$company)
            ->with('company_chart_of_accounts',$company_chart_of_accounts)
            ->with('account_types',$account_types)
            ->with('signs',$signs)
            ->with('account_groups',$account_groups)
            ->with('account_classes',$account_classes)
            ->with('maps',$maps)
            ->with('global_currency_codes',$global_currency_codes)
            ->with('company_tax_accounts',$company_tax_accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('add'))
            return redirect()->route('company-chart-of-accounts')->with('status', trans('You don\'t have permission to add.'));
        $company = Company::findOrFail(session('selected-company'));
        $group_sources = ChartOfAccountGroup::where('country_id',$company->country)->get();
        return view('v1.company-chart-of-accounts.import')
            ->with('group_sources',$group_sources);
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
            return redirect()->route('company-chart-of-accounts')->with('status', trans('You don\'t have permission to add.'));
        
        Validator::extend('unique_account', function ($attribute, $value, $parameters, $validator) use ($request){
            return CompanyChartOfAccount::where('company_id',session('selected-company'))->where('account_no',$request->account_no)->where('name',$request->name)->count() ? false : true;
        });
        $validator = $request->validate([
            'account_no' => 'required|unique_account',
            'name' => 'required',
            'account_type_id' => 'required',
            'sign_id' => 'required',
            'account_group_id_hidden' => 'required',
            'account_class_id' => 'required'
        ],['unique_account'=>'Account No and Name already existed']);
        $company_chart_of_account = new CompanyChartOfAccount;
        $company_chart_of_account->company_id = session('selected-company');
        $company_chart_of_account->account_no = $request->account_no;
        $company_chart_of_account->name = $request->name;
        $company_chart_of_account->map_no = $request->map_no;
        $company_chart_of_account->type = $request->account_type_id;
        $company_chart_of_account->normal_sign = $request->sign_id;
        $company_chart_of_account->group = $request->account_group_id_hidden;
        $company_chart_of_account->class = $request->account_class_id;
        $company_chart_of_account->opening_balance = number_format(str_replace(',','',$request->opening_balance),5);
        $company_chart_of_account->locked = $request->locked ? 1 : 0;
        $company_chart_of_account->adjustments = number_format(str_replace(',','',$request->adjustments),5);
        $company_chart_of_account->final_balance = number_format(str_replace(',','',$request->final_balance),5);
        $company_chart_of_account->description = $request->description;
        if($request->currency_hidden)
            $company_chart_of_account->currency = $request->currency_hidden;
        $company_chart_of_account->tax_account = $request->tax_account;
        $company_chart_of_account->save();
        $response = 'New Company Chart Of Account Added';
        auth()->user()->store_activity('added company chart of account - '.$company_chart_of_account->name);
        return redirect()->route('company-chart-of-accounts')->with('status',$response);
    }

    public function import(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('company-chart-of-accounts')->with('status', trans('You don\'t have permission to add.'));
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
                    if(CompanyChartOfAccount::where('company_id',session('selected-company'))->where('account_no',$gcoa->account_no)->count() < 1) {
                        $company_chart_of_account = new CompanyChartOfAccount;
                        $company_chart_of_account->company_id = session('selected-company');
                        $company_chart_of_account->account_no = $gcoa->account_no;
                        $company_chart_of_account->name = $gcoa->name;
                        $company_chart_of_account->map_no = $gcoa->$account_map_no_id;
                        $company_chart_of_account->type = $gcoa->account_type_id;
                        $company_chart_of_account->normal_sign = $gcoa->$normal_sign;
                        $company_chart_of_account->group = $gcoa->account_group_id;
                        $company_chart_of_account->class = $gcoa->account_class_id;
                        /*if($gcoa->nca)
                            $company_chart_of_account->nca = $gcoa->nca;*/
                        $company_chart_of_account->save();
                        auth()->user()->store_activity('added company chart of account - '.$company_chart_of_account->name);
                        $response[] = 'Added '.$gcoa->account_no.'-'.$gcoa->name;
                    } else {
                        $response[] = $gcoa->account_no.'-'.$gcoa->name.' already added';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('company-chart-of-accounts')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyChartOfAccount  $companyChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyChartOfAccount  $companyChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-chart-of-accounts')->with('status', trans('You don\'t have permission to edit.'));
        $company_chart_of_account = CompanyChartOfAccount::findOrFail($id);
        $classes = AccountClass::all();
        $groups = AccountGroup::all();
        $maps = CompanyAccountMap::where('company_id',session('selected-company'))->where('unassignable',0)->orderBy('parent_id')->orderBy('map_no')->get();
        //$maps = CompanyAccountMap::class_extractor($maps);
        $signs = Sign::all();
        $account_types = AccountType::all();
        $map_groups = MapGroup::all();
        $global_currency_codes = GlobalCurrencyCode::all();
        $company_tax_accounts = CompanySalesTax::where('company_id',session('selected-company'))->get();
        return view('v1.company-chart-of-accounts.edit')
            ->with('company_chart_of_account',$company_chart_of_account)
            ->with('classes',$classes)
            ->with('groups',$groups)
            ->with('maps',$maps)
            ->with('signs',$signs)
            ->with('account_types',$account_types)
            ->with('map_groups',$map_groups)
            ->with('global_currency_codes',$global_currency_codes)
            ->with('company_tax_accounts',$company_tax_accounts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyChartOfAccount  $companyChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-chart-of-accounts')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('unique_account', function ($attribute, $value, $parameters, $validator) use ($request,$id){
            return CompanyChartOfAccount::where('id','!=',$id)->where('company_id',session('selected-company'))->where('account_no',$request->account_no)->where('name',$request->name)->count() ? false : true;
        });
        $validator = $request->validate([
            'account_no' => 'required|unique_account',
            'name' => 'required',
            'type' => 'required',
            'normal_sign' => 'required',
            'group_hidden' => 'required',
            'class' => 'required'
        ],['unique_account'=>'Account No and Name already existed']);
        $company_chart_of_account = CompanyChartOfAccount::findOrFail($id);
        if(strtolower($company_chart_of_account->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company chart of account - '.$company_chart_of_account->name);
        else
            auth()->user()->store_activity('updated company chart of account - '.$company_chart_of_account->name.' to '.$request->name);
        $company_chart_of_account->account_no = $request->account_no;
        $company_chart_of_account->name = $request->name;
        $company_chart_of_account->map_no = $request->map_no;
        $company_chart_of_account->type = $request->type;
        /*$company_chart_of_account->nca = $request->nca;*/
        $company_chart_of_account->normal_sign = $request->normal_sign;
        $company_chart_of_account->group = $request->group_hidden;
        $company_chart_of_account->class = $request->class;
        $company_chart_of_account->opening_balance = number_format(str_replace(',','',$request->opening_balance),5);
        $company_chart_of_account->locked = $request->locked ? 1 : 0;
        $company_chart_of_account->adjustments = number_format(str_replace(',','',$request->adjustments),5);
        $company_chart_of_account->final_balance = number_format(str_replace(',','',$request->final_balance),5);
        $company_chart_of_account->description = $request->description;
        if($request->currency_hidden)
            $company_chart_of_account->currency = $request->currency_hidden;
        $company_chart_of_account->tax_account = $request->tax_account;
        $company_chart_of_account->save();
        $response = 'Updated';
        return redirect()->route('company-chart-of-accounts')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyChartOfAccount  $companyChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-chart-of-accounts')->with('status', trans('You don\'t have permission to delete.'));
        $company_chart_of_account = CompanyChartOfAccount::findOrFail($id);
        if($company_chart_of_account->g_journals->count())
            return redirect()->route('company-chart-of-accounts')->with('status', trans('Chart of Account used, cannot be deleted.'));
        auth()->user()->store_activity('deleted chart of account group list - '.$company_chart_of_account->name);
        $company_chart_of_account->delete();
        $response = 'Deleted';
        return redirect()->route('company-chart-of-accounts')->with('status',$response);
    }

    public function groupSource(Request $request)
    {
        if($request->group_source_id) {
            if($request->group_source_id == 'company_chart_of_accounts') {
                $load = ['account_map'=>function($query){
                    $query->with('parent_map');
                },'account_type','sign','account_group','account_class'];
                $test = CompanyChartOfAccount::where('company_id',session('selected-company'));
            } else {
                $load = ['account_map'=>function($query){
                    $query->with('parent_map');
                },'account_type','sign','account_group','account_class'];
                $test = ChartOfAccountGroupList::where('coag_id',$request->group_source_id)->whereNotIn('account_no',CompanyChartOfAccount::where('company_id',session('selected-company'))->pluck('account_no'));
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
            $request['total'] = 0;
        }
        return $request;
    }
}
