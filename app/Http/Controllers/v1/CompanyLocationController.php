<?php

namespace App\Http\Controllers\v1;

use App\CompanyLocation;
use App\Company;
use App\CountryCurrency;
use App\TimezoneData;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyLocationController extends Controller
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
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $company = Company::findOrFail(session('selected-company'));
        $tax_jurisdiction = $company->country_currency->state_provinces;
        return view('v1.company-locations.index')
            ->with('company',$company)
            ->with('tax_jurisdiction',$tax_jurisdiction);
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
            return redirect()->route('company-locations')->with('status', trans('You don\'t have permission to add.'));
        Validator::extend('location_name_cl_id_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return CompanyLocation::where('cl_id',$request->cl_id)->where('company_id',session('selected-company'))->where('name',$value)->count() ? false : true;
        });
        $validator = $request->validate([
            'cl_id' => 'required',
            'name' => 'required|location_name_cl_id_unique'
        ],[
            'cl_id.required'=>'Location No. Required',
            'location_name_cl_id_unique'=>'Location No. and Name already added'
        ]);
        $company_location = new CompanyLocation;
        $company_location->company_id = session('selected-company');
        $company_location->cl_id = $request->cl_id;
        $company_location->name = $request->name;
        $company_location->description = $request->description;
        $company_location->tax_jurisdiction = $request->tax_jurisdiction;
        $company_location->active = $request->active ? 1:0;
        $company_location->save();
        $response = 'Company Location Added';
        auth()->user()->store_activity('added company location - '.$company_location->name);
        return redirect()->route('company-locations')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyLocation  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyLocation  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-locations')->with('status', trans('You don\'t have permission to edit.'));
        $company_location = CompanyLocation::findOrFail($id);
        $tax_jurisdiction = $company_location->company->country_currency->state_provinces;
        return view('v1.company-locations.edit')
            ->with('company_location',$company_location)
            ->with('tax_jurisdiction',$tax_jurisdiction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyLocation  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-locations')->with('status', trans('You don\'t have permission to edit.'));
        Validator::extend('location_name_cl_id_unique', function ($attribute, $value, $parameters, $validator) use ($request,$id){
            return CompanyLocation::where('cl_id',$request->cl_id)->where('company_id',session('selected-company'))->where('name',$value)->where('id','!=',$id)->count() ? false : true;
        });
        $validator = $request->validate([
            'cl_id' => 'required',
            'name' => 'required|location_name_cl_id_unique'
        ],[
            'cl_id.required'=>'Location No. Required',
            'location_name_cl_id_unique'=>'Location No. and Name already added'
        ]);
        $company_location = CompanyLocation::findOrFail($id);
        if(strtolower($company_location->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company location - '.$company_location->name);
        else
            auth()->user()->store_activity('updated company location - '.$company_location->name.' to '.$request->name);
        $company_location->cl_id = $request->cl_id;
        $company_location->name = $request->name;
        $company_location->description = $request->description;
        $company_location->tax_jurisdiction = $request->tax_jurisdiction;
        $company_location->active = $request->active ? 1:0;
        $company_location->save();
        $response = 'Company Location Updated';
        return redirect()->route('company-locations')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyLocation  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-locations')->with('status', trans('You don\'t have permission to delete.'));
        $company_location = CompanyLocation::findOrFail($id);
        if(
            $company_location->company_segments->count()
            || $company_location->job_projects->count()
            || $company_location->g_journals->count()
            || $company_location->company_sales_taxes->count())
            return redirect()->route('company-locations')->with('status','Cannot Delete Location - Used.');
        auth()->user()->store_activity('deleted company location - '.$company_location->name);
        $company_location->delete();
        $response = 'Company Location Deleted';
        return redirect()->route('company-locations')->with('status',$response);
    }

    public function companyLocationAddress($id = null)
    {
        if($id) {
            if(!$this->selected_company())
                return redirect()->route('companies')->with('status',Controller::error_message(5));
            $address = CompanyLocation::findOrFail($id)->address->first();
            if(!$address)
                $address = [];
            //return $address;
            $countries = CountryCurrency::with('state_provinces')->get();
            $timezone_datas = TimezoneData::all();
            return view('v1.company-locations.address')
                ->with('countries',$countries)
                ->with('address',$address)
                ->with('timezone_datas',$timezone_datas);
        } else {
            $company_vendor = new CompanyLocation;
            $company_vendor->company_id = session('selected-company');
            $company_vendor->save();
            return redirect()->route('company-location.address',[$company_vendor->id]);
        }
    }

    public function updateCompanyLocationAddress(Request $request, $id)
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

        $company_vendor = CompanyLocation::findOrFail($id);
        
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

        $company_vendor->address()->sync([$address->id=>['model_type'=>'App\CompanyLocation']]);

        $response = 'Company Location Address Updated!';
        auth()->user()->store_activity('updated company location address - id#'.$address->id);

        return redirect()->route('company-location.address',[$id])->with('status', trans($response));
    }
}
