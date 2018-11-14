<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\CompanyDefaultAccount;

class CompanyDefaultAccountController extends Controller
{
    public function index()
    {
    	if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
    	$company = Company::find(session('selected-company'));
    	$company_default_accounts = $company->default_accounts;
        $company_chart_of_accounts = $company->chart_of_accounts;
    	return view('v1.company-default-accounts.create')
    		->with('company_chart_of_accounts',$company_chart_of_accounts)
    		->with('company_default_accounts',$company_default_accounts);
    }

    public function store(Request $request)
    {
    	$company = Company::find(session('selected-company'));
    	if($company->default_accounts->count()) {
    		$company_default_account = $company->default_accounts->first();
    		$response = 'Updated';
    		auth()->user()->store_activity('updated company default accounts for '.$company->trade_name);
    	} else {
    		$company_default_account = new CompanyDefaultAccount;
    		$company_default_account->company_key = $company->company_key;
			$company_default_account->retained_earnings = $request->retained_earnings;
			$response = 'Added';
			auth()->user()->store_activity('added company default accounts for '.$company->trade_name);
    	}
		$company_default_account->accounts_payable = $request->accounts_payable;
		$company_default_account->accounts_receivable = $request->accounts_receivable;
		$company_default_account->purchase_discounts = $request->purchase_discounts;
		$company_default_account->sales_discounts = $request->sales_discounts;
		$company_default_account->save();
		return redirect()->route('company-default-accounts')->with('status','Company Default Account '.$response);
    }
}
