<?php

namespace App\Http\Controllers\v1;

use App\NationalChartOfAccount;
use App\NationalChartOfAccountList;
use App\CountryCurrency;
use App\AccountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NationalChartOfAccountController extends Controller
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
        $ncas = NationalChartOfAccount::all();
        $countries = CountryCurrency::all();
        return view('v1.national-chart-of-accounts.index')
            ->with('ncas',$ncas)
            ->with('countries',$countries);
    }

    public function lists($id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $nca = NationalChartOfAccount::findOrFail($id);
        $nca_lists = $nca->lists()->get()->sortBy('code');
        $account_types = AccountType::all();
        return view('v1.national-chart-of-accounts.lists')
            ->with('nca',$nca)
            ->with('nca_lists',$nca_lists)
            ->with('account_types',$account_types);
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
            return redirect()->route('national-chart-of-accounts')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:national_chart_of_accounts',
            'country_id' => 'required',
            'short_name' => 'required'
        ]);
        $nca = new NationalChartOfAccount;
        $nca->name = $request->name;
        $nca->country_id = $request->country_id;
        $nca->short_name = $request->short_name;
        $nca->save();
        $response = 'New National Chart Of Account Added';
        auth()->user()->store_activity('added national chart of account - '.$nca->name);
        return redirect()->route('national-chart-of-accounts')->with('status',$response);
    }

    public function storeList(Request $request, $id)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('national-chart-of-account-lists',[$id])->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'code' => 'required|unique:national_chart_of_account_lists',
            'account_type_id' => 'required',
            'name' => 'required',
            'description' => ''
        ]);
        $nca = NationalChartOfAccount::findOrFail($id);
        $nca_list = new NationalChartOfAccountList;
        $nca_list->code = $request->code;
        $nca_list->account_type = $request->account_type_id;
        $nca_list->name = $request->name;
        $nca_list->description = $request->description ?: '';
        $nca->lists()->save($nca_list);
        $response = strtoupper($nca->name).' List Added';
        auth()->user()->store_activity('added '.strtoupper($nca->name).' list - '.$nca_list->name);
        return redirect()->route('national-chart-of-account-lists',[$id])->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NationalChartOfAccount  $nationalChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NationalChartOfAccount  $nationalChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('national-chart-of-accounts')->with('status', trans('You don\'t have permission to edit.'));
        $nca = NationalChartOfAccount::findOrFail($id);
        $countries = CountryCurrency::all();
        return view('v1.national-chart-of-accounts.edit')
            ->with('nca',$nca)
            ->with('countries',$countries);
    }

    public function editList($id)
    {
        $nca_list = NationalChartOfAccountList::findOrFail($id);
        if(!auth()->user()->can('edit'))
            return redirect()->route('national-chart-of-account-lists',[$nca_list->nca_id])->with('status', trans('You don\'t have permission to edit.'));
        $account_types = AccountType::all();
        return view('v1.national-chart-of-accounts.edit-list')
            ->with('nca_list',$nca_list)
            ->with('account_types',$account_types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NationalChartOfAccount  $nationalChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('national-chart-of-accounts')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:national_chart_of_accounts,name,'.$id,
            'country_id' => 'required',
            'short_name' => 'required'
        ]);
        $nca = NationalChartOfAccount::findOrFail($id);
        if($nca->name == $request->name)
            auth()->user()->store_activity('updated national chart of account - '.$nca->name);
        else
            auth()->user()->store_activity('updated national chart of account - '.$nca->name.' to '.$request->name);
        $nca->country_id = $request->country_id;
        $nca->name = $request->name;
        $nca->short_name = $request->short_name;
        $nca->save();
        $response = 'National Chart Of Account Updated';
        return redirect()->route('national-chart-of-accounts')->with('status',$response);
    }

    public function updateList(Request $request, $id)
    {
        $validator = $request->validate([
            'code' => 'required|unique:national_chart_of_account_lists,code,'.$id,
            'account_type_id' => 'required',
            'name' => 'required',
            'description' => ''
        ]);
        $nca_list = NationalChartOfAccountList::findOrFail($id);
        if(!auth()->user()->can('edit'))
            return redirect()->route('national-chart-of-account-lists',[$nca_list->nca_id])->with('status', trans('You don\'t have permission to edit.'));
        $nca_list->code = $request->code;
        $nca_list->account_type = $request->account_type_id;
        if($nca_list->name == $request->name)
            auth()->user()->store_activity('updated '.strtoupper($nca_list->nca->name).' list - '.$nca_list->name);
        else
            auth()->user()->store_activity('updated '.strtoupper($nca_list->nca->name).' list - '.$nca_list->name.' to '.$request->name);
        $nca_list->name = $request->name;
        $nca_list->description = $request->description ?: '';
        $nca_list->save();
        $response = 'National Chart Of Account List Updated';
        return redirect()->route('national-chart-of-account-lists',[$nca_list->nca_id])->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NationalChartOfAccount  $nationalChartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('national-chart-of-accounts')->with('status', trans('You don\'t have permission to delete.'));
        $nca = NationalChartOfAccount::findOrFail($id);
        if($nca->lists->count() || $nca->map_groups->count())
            return redirect()->route('national-chart-of-accounts')->with('status', trans(strtoupper($nca->name).' Used, Cannot be deleted.'));
        auth()->user()->store_activity('deleted national chart of account - '.$nca->name);
        $nca->delete();
        $response = 'National Chart Of Account Deleted';
        return redirect()->route('national-chart-of-accounts')->with('status',$response);
    }

    public function destroyList($id)
    {
        $nca_list = NationalChartOfAccountList::findOrFail($id);
        $nca_id = $nca_list->nca_id;
        if(!auth()->user()->can('delete'))
            return redirect()->route('national-chart-of-account-lists',[$nca_id])->with('status', trans('You don\'t have permission to delete.'));
        auth()->user()->store_activity('deleted '.strtoupper($nca_list->nca->name).' list - '.$nca_list->name);
        $nca_list->delete();
        $response = 'National Chart Of Account List Deleted';
        return redirect()->route('national-chart-of-account-lists',[$nca_id])->with('status',$response);
    }

    public function showNCA($country_id = null)
    {
        if($country_id)
            $nca = NationalChartOfAccount::where('country_id',$country_id)->get();
        else
            $nca = [];
        return $nca;
    }
}
