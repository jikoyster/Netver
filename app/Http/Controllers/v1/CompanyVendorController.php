<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\CompanyVendor;
use App\Company;
use App\NaicsCode;
use App\GlobalCurrencyCode;
use App\RegistrationType;
use App\CountryCurrency;
use App\TimezoneData;
use App\Address;

class CompanyVendorController extends Controller
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
        $company = Company::findOrFail(session('selected-company'));
        $company_vendors = $company->vendors->where('email','!=',null);
        return view('v1.company-vendors.index')
            ->with('company',$company)
            ->with('company_vendors',$company_vendors);
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
        $company = Company::find(session('selected-company'));
        $global_currency = GlobalCurrencyCode::all();
        $registration_types = RegistrationType::all();
        return view('v1.company-vendors.add')
            ->with('company',$company)
            ->with('global_currency',$global_currency)
            ->with('registration_types',$registration_types);
    }

    public function address($id = null)
    {
        if($id) {
            if(!$this->selected_company())
                return redirect()->route('companies')->with('status',Controller::error_message(5));
            $address = CompanyVendor::findOrFail($id)->address->first();
            if(!$address)
                $address = [];
            //return $address;
            $countries = CountryCurrency::with('state_provinces')->get();
            $timezone_datas = TimezoneData::all();
            return view('v1.company-vendors.address')
                ->with('countries',$countries)
                ->with('address',$address)
                ->with('timezone_datas',$timezone_datas);
        } else {
            $company_vendor = new CompanyVendor;
            $company_vendor->company_id = session('selected-company');
            $company_vendor->save();
            return redirect()->route('company-vendor.address',[$company_vendor->id]);
        }
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
            return redirect()->route('company-vendors')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('with_company_multi_currency', function ($attribute, $value, $parameters, $validator) use ($request){
            return Company::where('id',session('selected-company'))->where('multi_currency',1)->count() ? true : false;
        });
        $validator = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'email' => 'required',
            'currency' => 'required',
            'registration_type' => 'required',
            'subcontractor' => 'required'
        ],['with_company_multi_currency'=>'Please check multi currency on company profile']);
        $company_vendor = new CompanyVendor;
        $company_vendor->company_id = session('selected-company');
        $company_vendor->title = $request->title;
        $company_vendor->first_name = $request->first_name;
        $company_vendor->middle_name = $request->middle_name;
        $company_vendor->last_name = $request->last_name;
        $company_vendor->suffix = $request->suffix;
        $company_vendor->company = $request->company;
        $company_vendor->email = $request->email;
        $company_vendor->display_name = $request->display_name;
        $company_vendor->print_cheque_as = $request->print_cheque_as;
        $company_vendor->use_display_name = $request->use_display_name ? 1:0;
        $company_vendor->website = $request->website;
        $company_vendor->description = $request->description;
        $company_vendor->subcontractor = $request->subcontractor;
        $company_vendor->track_payment_t4a = $request->track_payment_t4a ? 1:0;
        $company_vendor->track_payment_5018 = $request->track_payment_5018 ? 1:0;
        $company_vendor->track_payment_1099 = $request->track_payment_1099 ? 1:0;
        $company_vendor->vendor_is_tax_agency = $request->vendor_is_tax_agency ? 1:0;
        $company_vendor->phone = $request->phone;
        $company_vendor->fax = $request->fax;
        $company_vendor->account_no = $request->account_no;
        $company_vendor->currency = $request->currency;
        $company_vendor->billing_rate = $request->billing_rate;
        $company_vendor->tax_id = $request->tax_id;
        $company_vendor->registration_type = $request->registration_type;
        $company_vendor->term = $request->term;
        $company_vendor->trade = $request->trade;
        $company_vendor->credit_limit = $request->credit_limit;
        $company_vendor->status = $request->status;
        $company_vendor->save();
        $response = 'Company Vendor Added';
        auth()->user()->store_activity('added company vendor - '.$company_vendor->company);
        return redirect()->route('company-vendors')->with('status',$response);
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
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-vendors')->with('status', trans('You don\'t have permission to edit.'));
        $company_vendor = CompanyVendor::findOrFail($id);
        $global_currency = GlobalCurrencyCode::all();
        $registration_types = RegistrationType::all();
        $company = Company::find(session('selected-company'));
        $country = $company->country_currency;
        $trades = $company->trades;
        $terms = $company->terms;
        return view('v1.company-vendors.edit')
            ->with('company_vendor',$company_vendor)
            ->with('country',$country)
            ->with('global_currency',$global_currency)
            ->with('registration_types',$registration_types)
            ->with('trades',$trades)
            ->with('terms',$terms);
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
            return redirect()->route('company-vendors')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('with_company_multi_currency', function ($attribute, $value, $parameters, $validator) use ($request){
            return Company::where('id',session('selected-company'))->where('multi_currency',1)->count() ? true : false;
        });
        $validator = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'email' => 'required',
            'currency' => 'required',
            'registration_type' => 'required',
            'subcontractor' => 'required'
        ],['with_company_multi_currency'=>'Please check multi currency on company profile']);
        $company_vendor = CompanyVendor::findOrFail($id);
        $company_vendor->title = $request->title;
        $company_vendor->first_name = $request->first_name;
        $company_vendor->middle_name = $request->middle_name;
        $company_vendor->last_name = $request->last_name;
        $company_vendor->suffix = $request->suffix;
        $company_vendor->company = $request->company;
        $company_vendor->email = $request->email;
        $company_vendor->display_name = $request->display_name;
        $company_vendor->print_cheque_as = $request->print_cheque_as;
        $company_vendor->use_display_name = $request->use_display_name ? 1:0;
        $company_vendor->website = $request->website;
        $company_vendor->description = $request->description;
        $company_vendor->subcontractor = $request->subcontractor;
        $company_vendor->track_payment_t4a = $request->track_payment_t4a ? 1:0;
        $company_vendor->track_payment_5018 = $request->track_payment_5018 ? 1:0;
        $company_vendor->track_payment_1099 = $request->track_payment_1099 ? 1:0;
        $company_vendor->vendor_is_tax_agency = $request->vendor_is_tax_agency ? 1:0;
        $company_vendor->phone = $request->phone;
        $company_vendor->fax = $request->fax;
        $company_vendor->account_no = $request->account_no;
        $company_vendor->currency = $request->currency;
        $company_vendor->billing_rate = $request->billing_rate;
        $company_vendor->tax_id = $request->tax_id;
        $company_vendor->registration_type = $request->registration_type;
        $company_vendor->term = $request->term;
        $company_vendor->trade = $request->trade;
        $company_vendor->credit_limit = $request->credit_limit;
        $company_vendor->status = $request->status;
        $company_vendor->save();
        $response = 'Company Vendor Updated';
        auth()->user()->store_activity('updated company vendor - '.$company_vendor->company);
        return redirect()->route('company-vendors')->with('status',$response);
    }

    public function updateAddress(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-vendor.address')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'country' => 'required',
            'state_province' => 'required',
            'line1' => '',
            'line2' => '',
            'city' => '',
            'zipcode' => '',
            'time_zone' => 'required'
        ]);

        $company_vendor = CompanyVendor::findOrFail($id);
        
        if($company_vendor->address->count()) {
            $address = Address::find($company_vendor->address->first()->id);
            /*$addHistory = new AddressHistory;
            $addHistory->address_id = $address->id;
            $addHistory->state_province_name = $address->state_province_name;
            $addHistory->line1 = $address->line1;
            $addHistory->line2 = $address->line2;
            $addHistory->city = $address->city;
            $addHistory->zip_code = $address->zip_code;
            $addHistory->time_zone = $address->time_zone;
            $addHistory->save();*/
        } else {
            $address = new Address;
        }
        
        $address->state_province_name = $request->state_province;
        $address->line1 = ($request->line1) ? $request->line1 : '';
        $address->line2 = ($request->line2) ? $request->line2 : '';
        $address->city = ($request->city) ? $request->city : '';
        $address->zip_code = ($request->zipcode) ? $request->zipcode : '';
        $address->time_zone = ($request->time_zone) ? $request->time_zone : '';
        $address->save();

        $company_vendor->address()->sync([$address->id=>['model_type'=>'App\CompanyVendor']]);

        $response = 'Company Vendor Address Updated!';
        auth()->user()->store_activity('updated company vendor address - id#'.$address->id);

        return redirect()->route('company-vendor.address',[$id])->with('status', trans($response));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-vendors')->with('status', trans('You don\'t have permission to delete.'));
        $company_vendor = CompanyVendor::findOrFail($id);
        auth()->user()->store_activity('deleted company vendor - '.$company_vendor->company);
        $company_vendor->delete();
        $response = 'Deleted Company Vendor';
        return redirect()->route('company-vendors')->with('status',$response);
    }
}
