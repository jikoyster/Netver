<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\CompanyFiscalPeriod;
use App\Company;

class CompanyFiscalPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company_fiscal_periods = CompanyFiscalPeriod::all();
        return view('v1.company-fiscal-periods.index')
            ->with('company_fiscal_periods',$company_fiscal_periods);
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
            return redirect()->route('company-fiscal-periods')->with('status', trans('You don\'t have permission to edit.'));
        $company = Company::find(session('selected-company'));
        $company_fiscal_periods = $company->fiscal_periods;
        $company_chart_of_accounts = $company->chart_of_accounts;
        return view('v1.company-fiscal-periods.create')
            ->with('company_fiscal_periods',$company_fiscal_periods)
            ->with('company_chart_of_accounts',$company_chart_of_accounts);
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
            return redirect()->route('company-fiscal-periods')->with('status', trans('You don\'t have permission to add.'));
        Validator::extend('below_one_year', function ($attribute, $value, $parameters, $validator) use ($request){
            $date1=date_create($request->start_date);
            $date2=date_create($request->end_date);
            $diff=date_diff($date1,$date2);
            return $diff->format("%a") > 365 ? false : true;
        });
        Validator::extend('under_end_date', function ($attribute, $value, $parameters, $validator) use ($request){
            $date1=strtotime($request->start_date);
            $date2=strtotime($request->end_date);
            return $date1 > $date2 ? false : true;
        });

        $company = Company::find(session('selected-company'));
        $data['fiscal_year'] = '';

        $date2 = date_create($request->end_date);

        if(!$company->fiscal_periods->count()) {
            $data['end_date'] = 'required';
            $data['start_date'] = 'required|under_end_date|below_one_year';
            //$data['retained_earning_account'] = 'required';
        } else {
            $date1 = date_create($company->fiscal_periods->last()->end_date);
            $new_start = date_add($date1,date_interval_create_from_date_string("1 day"));
            $request->start_date = date_format($new_start,'Y-m-d');
            
            $new_end = date_add($date2,date_interval_create_from_date_string("1 year"));
            $request->end_date = date_format($new_end,'Y-m-d');
        }
        $validator = $request->validate($data,[
            'below_one_year'=>'Date cannot be more than 1 year before the year end',
            'under_end_date'=>'Date cannot be later than year end'
        ]);

        $company_fiscal_period = new CompanyFiscalPeriod;
        $company_fiscal_period->user_id = auth()->user()->id;
        $company_fiscal_period->company_key = $company->company_key;
        $company_fiscal_period->fiscal_year = date_format($date2,'Y');
        $company_fiscal_period->end_date = $request->end_date;
        $company_fiscal_period->start_date = $request->start_date;
        //$company_fiscal_period->retained_earning_account = $request->retained_earning_account;
        $company_fiscal_period->save();
        $response = 'New Company Fiscal Period Added';
        auth()->user()->store_activity('added company fiscal period - '.$company_fiscal_period->fiscal_year);
        return redirect()->route('company-fiscal-periods')->with('status',$response);
    }

    public function select(Request $request)
    {
        $company = Company::findOrFail(session('selected-company'));
        $company_fiscal_period = $company->fiscal_periods()->where('fiscal_year',$request->fiscal_year)->first();
        session(['selected-company-fiscal-period'=>$company_fiscal_period]);
        return view('v1.company-fiscal-periods.blank');
        //return redirect()->route('companies')->with('status',$company->legal_name.' Selected');
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
            return redirect()->route('company-fiscal-periods')->with('status', trans('You don\'t have permission to edit.'));
        $company_fiscal_period = CompanyFiscalPeriod::findOrFail($id);
        return view('v1.company-fiscal-periods.edit')
            ->with('company_fiscal_period',$company_fiscal_period);
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
            return redirect()->route('company-fiscal-periods')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'fiscal_year' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $company_fiscal_period = CompanyFiscalPeriod::findOrFail($id);
        auth()->user()->store_activity('updated company fiscal period');
        $company_fiscal_period->fiscal_year = $request->fiscal_year;
        $company_fiscal_period->end_date = $request->end_date;
        $company_fiscal_period->start_date = $request->start_date;
        $company_fiscal_period->save();
        $response = 'Company Fiscal Period Updated';
        return redirect()->route('company-fiscal-periods')->with('status',$response);
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
            return redirect()->route('company-fiscal-periods')->with('status', trans('You don\'t have permission to delete.'));
        $company_fiscal_period = CompanyFiscalPeriod::findOrFail($id);
        auth()->user()->store_activity('deleted company fiscal period - '.$company_fiscal_period->fiscal_year);
        $company_fiscal_period->delete();
        $response = 'Company Fiscal Period Deleted';
        return redirect()->route('company-fiscal-periods')->with('status',$response);
    }
}
