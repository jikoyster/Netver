<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\User;
use App\Company;
use App\CompanyOwner;
use App\Designation;
use App\RegistrationType;
use App\CountryCurrency;
use App\TimezoneData;
use App\MenuRole;
use App\Address;
use App\NaicsCode;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function getCompanies($val)
    {
        if($val) {
            $companies = Company::where('account_no',$val)->get();
            if($companies->count() < 1)
                $companies = Company::where('id',$val)->get();
        } else {
            $companies = Company::where('id',session('selected-company'))->get();
        }
        return $companies;
    }

    public function index($account_no = 0)
    {
        $companies = $this->getCompanies($account_no);
        if(!$companies->count())
            app()->abort(404);
        if($companies->first()->owner()->first()->user_id != auth()->user()->id && !(auth()->user()->hasRole('system admin') || auth()->user()->hasRole('super admin')))
            return redirect()->route('home')->with('error_message',Controller::error_message());
        if(!auth()->user()->can('edit'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to edit.'));
        $registration_types = RegistrationType::all();
        $countries = CountryCurrency::all();
        $timezone_datas = TimezoneData::all();
    	if($companies->count() < 1) {
    		$response = "Invalid Account Number!";
    		return redirect()->route('company.businesses')->with('status',$response);
    	}
        $naics = NaicsCode::all();
    	return view('v1.company.index')
            ->with('companies',$companies)
            ->with('registration_types',$registration_types)
            ->with('countries',$countries)
            ->with('timezone_datas',$timezone_datas)
            ->with('naics',$naics);
    }

    public function accountantProfile($id = 0)
    {
        if(!$this->selected_company() && !$id)
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        //$company = $id ? Company::where('id',$id)->orWhere('account_no',$id)->first() : auth()->user()->owned_companies->first()->company;
        $company = $id ? Company::where('id',$id)->orWhere('account_no',$id)->first() : Company::findOrFail(session('selected-company'));
        $user = $company->owner->user;
        $designations = Designation::all();
        $registration_types = RegistrationType::all();
        $countries = CountryCurrency::all();
        $timezone_datas = TimezoneData::all();
        return view('v1.companies.profile-accountant')
            ->with('user',$user)
            ->with('company',$company)
            ->with('designations',$designations)
            ->with('registration_types',$registration_types)
            ->with('countries',$countries)
            ->with('timezone_datas',$timezone_datas);
    }

    public function accountantUpdateProfile(Request $request, $segment2 = null, $id = 0)
    {
        /*$file = $request->file('company_logo');
        return $file->getClientOriginalName().'-('.$file->getClientOriginalExtension().')-'.$file->getRealPath().'-('.$file->getSize().')-'.$file->getMimeType();*/
        $validator = $request->validate([
            'trade_name' => 'required|unique:companies,trade_name,'.$request->id,
            'designation_id' => 'required',
            'contact_person' => 'required',
            'contact_person_email' => 'required|email',
            'registration_type_id' => 'required',
            'country' => 'required',
            'company_logo' => '',
            'company_email' => 'required|string|email|unique:companies,company_email,'.$request->id,
            'phone' => 'required',
            'fax' => '',
            'time_zone' => '',
            'daylight_saving_time' => ''
        ]);

        $company = Company::find($request->id);
        $company->company_type = 'accounting';
        $company->trade_name = $request->trade_name;
        $company->contact_person = $request->contact_person;
        $company->contact_person_email = $request->contact_person_email;
        $company->display_name = $request->trade_name;
        $company->registration_type_id = $request->registration_type_id;
        $company->country = $request->country;
        $company->company_email = $request->company_email;
        $company->phone = $request->phone;
        $company->fax = $request->fax;
        $company->time_zone = $request->time_zone;
        $company->daylight_saving_time = $request->daylight_saving_time;
        $company_logo = $request->file('company_logo');
        if($company_logo) {
            $path = $company_logo->storeAs('public/company_logos',$request->id.'.'.$company_logo->getClientOriginalExtension());
            $company->company_logo = $request->id.'.'.$company_logo->getClientOriginalExtension();
        }
        $company->save();

        $user = User::findOrFail($company->owner->user->id);
        $user->designation_id = $request->designation_id;
        $user->save();

        $response = 'Profile Updated!';
        auth()->user()->store_activity('Update Company Profile - '.$company->trade_name);
        $redirect1 = auth()->user()->groups->first()->id == 2 ? 'accountant.profile':'accounting-companies';
        $redirect = session('selected-company') != $company->id ? $redirect1 : 'companies';
        $redirect2 = $segment2 != 'accounting-profile' ? $redirect : 'accounting-companies';
        return redirect()->route($id && $segment2 != 'profile' ? $redirect2 : 'companies')->with('status', trans($response));
    }

    public function address($id)
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $address = Company::where('id',$id)->orWhere('account_no',$id)->first()->owner->user->address->first();
        if(!$address)
            $address = [];
        //return $address;
        $countries = CountryCurrency::with('state_provinces')->get();
        $timezone_datas = TimezoneData::all();
        return view('v1.companies.address')
            ->with('id',$id)
            ->with('countries',$countries)
            ->with('address',$address)
            ->with('timezone_datas',$timezone_datas);
    }

    public function updateAdd(Request $request,$id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('user.address')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'country' => 'required',
            'state_province' => '',
            'line1' => '',
            'line2' => '',
            'city' => '',
            'zipcode' => '',
            'time_zone' => 'required'
        ]);

        $user = Company::where('id',$id)->orWhere('account_no',$id)->first()->owner->user;
        
        if($user->address->count()) {
            $address = Address::find($user->address->first()->id);

            $addHistory = new AddressHistory;
            $addHistory->address_id = $address->id;
            $addHistory->state_province_name = $address->state_province_name;
            $addHistory->line1 = $address->line1;
            $addHistory->line2 = $address->line2;
            $addHistory->city = $address->city;
            $addHistory->zip_code = $address->zip_code;
            $addHistory->time_zone = $address->time_zone;
            $addHistory->save();
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
        $user->address()->sync([$address->id=>['model_type'=>'App\User']]);

        $response = 'User Address Updated!';
        $user->store_activity('updated address - id#'.$address->id);

        return redirect()->route('accounting-companies.address',$id)->with('status', trans($response));
    }

    public function businesses()
    {
    	$companies = Auth::user()->companies()->get();//User::findOrFail(Auth::id())->companiess()->get();
    	return view('v1.company.businesses')->with('companies',$companies);
    }

    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to add.'));
    	/*$validator = $request->validate([
            'trade_name' => 'required|unique:companies,trade_name'
        ],[
        	'trade_name.unique'=>'The trade name ":input" has already been taken.'
        ]);*/
        $validator = $request->validate([
            'account_no' => 'required|unique:companies',
            'display_name' => 'required',
            'trade_name' => 'required',
            'legal_name' => 'required'
        ]);

    	$random_string = str_limit(strtoupper(md5(microtime())),6,'');
    	
    	$company = new Company;
        $company->company_key = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0x0fff ) | 0x4000, mt_rand( 0, 0x3fff ) | 0x8000, mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
    	$company->display_name = $request->display_name;
        $company->legal_name = $request->legal_name;
        $company->trade_name = $request->trade_name;
    	$company->account_no = $request->account_no;//$random_string;
        $company->save();

        $company_owner = new CompanyOwner;
        $company_owner->company_id = $company->id;
        $company_owner->date_ownership = now();
        $company_owner->ownership_percentage = 100;
        $company_owner->leave_ownership = '0001-01-01';

        Auth::user()->owned_companies()->save($company_owner);
        Auth::user()->companies()->attach($company->id); // new

    	$response = 'New Company Added!';
    	return redirect()->route('companies')->with('status',$response);
    }

    public function lists()
    {
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        if(!(Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin')))
            $companies = Auth::user()->companies;//return redirect()->route('home')->with('error_message','System Admin Only');
        else
            $companies = Company::all();
        $selected_company = Company::find(session('selected-company'));
        return view('v1.companies.index')
            ->with('companies',$companies)
            ->with('selected_company',$selected_company);
    }

    public function accountants()
    {
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        if(!(Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin')))
            $companies = Auth::user()->companies;//return redirect()->route('home')->with('error_message','System Admin Only');
        else
            $companies = Company::where('company_type','accounting')->get();
        return view('v1.companies.accountants')
            ->with('companies',$companies);
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to edit.'));
        $user = Auth::user();
        $company = Company::findOrFail($id);
        $designations = Designation::all();
        $registration_types = RegistrationType::all();
        $countries = CountryCurrency::all();
        $timezone_datas = TimezoneData::all();
        /*return view('v1.user.profile-accountant')
            ->with('user',$user)
            ->with('company',$company)
            ->with('designations',$designations)
            ->with('registration_types',$registration_types)
            ->with('countries',$countries)
            ->with('timezone_datas',$timezone_datas);*/
        return view('v1.companies.edit')
            ->with('company',$company);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'trade_name' => 'required|unique:companies,trade_name,'.$id
        ],[
            'trade_name.unique'=>'The trade name ":input" has already been taken.'
        ]);

        $company = Company::findOrFail($id);
        $company->trade_name = $request->trade_name;
        $company->save();

        $response = 'Account Type Updated!';
        return redirect()->route('companies')->with('status', trans($response));
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        if(!auth()->user()->can('edit'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to edit.'));
        $data['trade_name'] = 'required|unique:companies,trade_name,'.$id;
        $data['display_name'] = 'required';
        $data['legal_name'] = 'required';
        $data['company_email'] = 'required';
        $data['registration_type'] = 'required';
        $data['phone'] = 'required';
        $data['fax'] = '';
        $data['time_zone'] = 'required';
        $data['company_logo'] = '';
        if(true) {
            $data['country_hidden'] = 'required';
            $data['home_currency_hidden'] = 'required';
            $data['tax_jurisdiction_hidden'] = 'required';
        }
        $validator = $request->validate($data,[
            'trade_name.unique'=>'The trade name ":input" has already been taken.'
        ]);

        if(!$request->ajax) {
            $company->trade_name = $request->trade_name;
            $company->display_name = $request->display_name;
            $company->legal_name = $request->legal_name;
            $company->company_email = $request->company_email;
            $company->registration_type_id = $request->registration_type;
            $company->phone = $request->phone;
            if(true) {
                $company->country = $request->country_hidden;
                $company->currency = $request->home_currency_hidden;
                $company->multi_currency = $request->multi_currency_hidden == 'true' ? 1 : 0;
                $company->tax_jurisdiction = $request->tax_jurisdiction_hidden;
            }
            $company->fax = $request->fax;
            $company->time_zone = $request->time_zone;
            $company->daylight_saving_time = $request->daylight_saving_time ? 1 : 0;
            $company_logo = $request->file('company_logo');
            $company->industry = $request->industry;
            if($company_logo) {
                $path = $company_logo->storeAs('public/company_logos',$id.'.'.$company_logo->getClientOriginalExtension());
                $company->company_logo = $id.'.'.$company_logo->getClientOriginalExtension();
            }
            $company->save();

            $response = 'Company Profile Updated!';
            Auth::user()->store_activity('Update Company Profile - '.$company->trade_name);
            return redirect()->route('companies')->with('status', trans($response));

        } else {
            return 'Ready to update!';
        }
    }

    public function destroy($id)
    {
        /*if(!(Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin')))
            return redirect()->route('home')->with('error_message',Controller::error_message(2));*/
        if(!auth()->user()->can('delete'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to delete.'));

        $company = Company::findOrFail($id);
        if(
            $company->locations->count()
            || $company->segments->count()
            || $company->job_projects->count()
            || $company->documents->count()
            || $company->chart_of_accounts->count()
            || $company->account_maps->count()
            || $company->journals->count()
            || $company->vendors->count()
            || $company->terms->count()
            || $company->g_journals->count()
            || $company->trades->count()
            || $company->address->count()
            || $company->account_split_items->count()
            || $company->fiscal_periods->count()
            || $company->default_accounts->count())
            return redirect()->route('companies')->with('status','Cannot Delete Company - Used.');
        Auth::user()->store_activity('deleted company - '.$company->trade_name);
        /*$company->locations()->delete();
        $company->segments()->delete();
        $company->job_projects()->delete();*/
        $company->users()->detach();
        $company->owner()->delete();
        $company->delete();
        $response = 'Company Deleted!';

        return redirect()->route('companies')->with('status', trans($response));
    }

    public function users($company_id)
    {
        $invited_users = Auth::user()->invited_users;
        $company = Company::findOrFail($company_id);
        /*if($company->owner()->first()->user_id != auth()->user()->id && !(auth()->user()->hasRole('system admin') || auth()->user()->hasRole('super admin')))
            return redirect()->route('home')->with('error_message',Controller::error_message());*/
        return view('v1.companies.index-users')
            ->with('invited_users',$invited_users)
            ->with('company',$company);
    }

    public function storeUser(Request $request, $company_id)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('companies')->with('status', trans('You don\'t have permission to add.'));
        Validator::extend('company_user_unique', function ($attribute, $value, $parameters, $validator) use ($company_id){
            return Company::find($company_id)->users()->where('user_id',$value)->count() ? false : true;
        });

        $validator = $request->validate([
            'user_id' => 'required|company_user_unique'
        ],['company_user_unique'=>'User already added under this company!','required'=>'User is required!']);

        $company = Company::find($company_id);
        $company->users()->attach($request->user_id);

        $response = 'New User Added!';
        return redirect()->route('company.users',[$company_id])->with('status',$response);
    }

    public function destroyUser($company_id, $id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('company.users',[$company_id])->with('status', trans('You don\'t have permission to delete.'));
        $company = Company::findOrFail($company_id);
        if($company->owner->user_id == $id) {
            $response = 'You are not able to inactivate your own user profile!';
        }
        else {
            //$company->users()->detach($id);
            $company->users()->updateExistingPivot($id,['inactive'=>1]);
            $response = 'User Inactivated!';
        }

        return redirect()->route('company.users',[$company_id])->with('status', trans($response));
    }

    public function selectCompany($id)
    {
        session()->forget('selected-company-fiscal-period');
        $company = Company::findOrFail($id);
        session(['selected-company'=>$id]);
        return redirect()->route('company-fiscal-periods')->with('status',$company->legal_name.' Selected');
    }

    public function clearCompany($id)
    {
        $company = Company::findOrFail($id);
        session()->forget('selected-company');
        session()->forget('selected-company-fiscal-period');
        return redirect()->route('companies')->with('status',$company->legal_name.' Closed');
    }

    public function companyAddress($id = null)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!$id)
            $id = session('selected-company');
        $companies = $this->getCompanies($id);
        $company = $companies->first();
        $address = $companies->first()->address->first();
        if(!$address)
            $address = [];
        //return $address;
        $countries = CountryCurrency::with('state_provinces')->get();
        $timezone_datas = TimezoneData::all();
        return view('v1.companies.company-address')
            ->with('countries',$countries)
            ->with('address',$address)
            ->with('timezone_datas',$timezone_datas)
            ->with('company',$company);
    }

    public function updateCompanyAddress(Request $request, $id = null)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-vendor.address')->with('status', trans('You don\'t have permission to edit.'));
        if(!$id)
            $id = session('selected-company');
        $validator = $request->validate([
            'country' => '',
            'state_province' => '',
            'line1' => '',
            'line2' => '',
            'city' => '',
            'zipcode' => '',
            'time_zone' => 'required'
        ]);

        $companies = $this->getCompanies($id);
        $company = $companies->first();
        
        if($company->address->count()) {
            $address = Address::find($company->address->first()->id);
        } else {
            $address = new Address;
        }
        
        $address->state_province_name = $company->tax_jurisdiction;
        $address->line1 = ($request->line1) ? $request->line1 : '';
        $address->line2 = ($request->line2) ? $request->line2 : '';
        $address->city = ($request->city) ? $request->city : '';
        $address->zip_code = ($request->zipcode) ? $request->zipcode : '';
        $address->time_zone = ($request->time_zone) ? $request->time_zone : '';
        $address->save();

        $company->address()->sync([$address->id=>['model_type'=>'App\Company']]);

        $response = 'Company Address Updated!';
        auth()->user()->store_activity('updated company address - id#'.$address->id);

        return redirect()->route('company.address',[$id])->with('status', trans($response));
    }
}
