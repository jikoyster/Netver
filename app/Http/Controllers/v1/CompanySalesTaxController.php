<?php

namespace App\Http\Controllers\v1;

use App\CompanySalesTax;
use App\GroupedCompanySalesTax;
use App\CountryCurrency;
use App\TaxRate;
use App\GroupedTaxRate;
use App\CompanyVendor;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CompanySalesTaxController extends Controller
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
        $company = Company::find(session('selected-company'));
        $company_locations = $company->locations;
        $tax_rates = CompanySalesTax::where('company_id',session('selected-company'))->with('grouped_tax_rates')->get();
        $countries = CountryCurrency::all();
        $company_vendors = $company->vendors->where('vendor_is_tax_agency',1);
        return view('v1.company-sales-taxes.index')
            ->with('tax_rates',$tax_rates)
            ->with('countries',$countries)
            ->with('company_vendors',$company_vendors)
            ->with('company_locations',$company_locations);
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
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to add.'));
        $company = Company::find(session('selected-company'));
        $company_locations = $company->locations;
        $countries = CountryCurrency::all();
        $company_vendors = $company->vendors->where('vendor_is_tax_agency',1);
        return view('v1.company-sales-taxes.add-grouped')
            ->with('countries',$countries)
            ->with('company_vendors',$company_vendors)
            ->with('company_locations',$company_locations);
    }

    public function import()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('add'))
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to add.'));
        return view('v1.company-sales-taxes.import');
    }

    public function import_save(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        
        $test = new TaxRate;

        if($request->term_ids) {
            foreach($request->term_ids as $id) {
                if($id != 'all') {
                    $gcoa = $test::findOrFail($id);
                    if(CompanySalesTax::where('company_id',session('selected-company'))->where('name',$gcoa->name)->where('province_state',$gcoa->province_state)->count() < 1) {
                        $company_sales_tax = new CompanySalesTax;
                        $company_sales_tax->company_id = session('selected-company');
                        $company_sales_tax->tax_code = strtoupper($gcoa->tax_code);
                        $company_sales_tax->name = $gcoa->name;
                        $company_sales_tax->province_state = $gcoa->province_state;
                        $company_sales_tax->city = $gcoa->city;
                        $company_sales_tax->tax_rate = $gcoa->tax_rate;
                        $company_sales_tax->save();
                        auth()->user()->store_activity('imported company term - '.$company_sales_tax->name);

                        /* auto edit 09242018 */
                        if($gcoa->grouped_tax_rates->count()) {
                            foreach($gcoa->grouped_tax_rates as $gtr_id) {
                                $tax_rate = TaxRate::find($gtr_id->tax_rate_id);
                                $exist = CompanySalesTax::where('company_id',session('selected-company'))->where('name',$tax_rate->name)->where('province_state',$tax_rate->province_state);
                                if($exist->count() < 1) {
                                    $cst = new CompanySalesTax;
                                    $cst->company_id = session('selected-company');
                                    $cst->tax_code = strtoupper($tax_rate->tax_code);
                                    $cst->name = $tax_rate->name;
                                    $cst->province_state = $tax_rate->province_state;
                                    $cst->city = $tax_rate->city;
                                    $cst->tax_rate = $tax_rate->tax_rate;
                                    $cst->save();
                                } else {
                                    $cst = $exist->first();
                                }

                                $gcst = new GroupedCompanySalesTax;
                                $gcst->tax_rate_id = $cst->id;
                                $company_sales_tax->grouped_tax_rates()->save($gcst);
                            }
                            return redirect()->route('company-sales-tax.edit-grouped',[$company_sales_tax->id]);
                        } else {
                            return redirect()->route('company-sales-tax.edit',[$company_sales_tax->id]);
                        }
                        /* end auto edit */

                        $response[] = 'Imported '.$gcoa->name;
                    } else {
                        $response[] = $gcoa->name.' already imported';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('company-sales-taxes')->with('status',$response);
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
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            '_location' => 'required',
            '_name' => 'required',
            '_tax_code' => 'required',
            '_country' => 'required',
            '_province_state' => 'required',
            '_tax_rate' => 'required_without:tax_rate_ids'
        ],['required_without'=>'Tax Rate is required']);
        $tax_rate = new CompanySalesTax;
        $tax_rate->company_id = session('selected-company');
        $tax_rate->tax_code = strtoupper($request->_tax_code);
        $tax_rate->location = $request->_location;
        $tax_rate->name = $request->_name;
        $tax_rate->province_state = $request->_province_state;
        $tax_rate->city = $request->_city;
        $tax_rate->tax_rate = $request->_tax_rate;
        $tax_rate->tax_agency = $request->_tax_agency;
        if($request->_start_date)
            $tax_rate->start_date = $request->_start_date.' 00:00:01';
        if($request->_end_date)
            $tax_rate->end_date = $request->_end_date.' 24:00:00';
        $tax_rate->save();
        if(count($request->tax_rate_ids)) {
            $total_rate = 0;
            foreach($request->tax_rate_ids as $id) {
                if($id != 'all') {
                    $rate = CompanySalesTax::findOrFail($id);
                    $total_rate += $rate->tax_rate;
                    $grouped = new GroupedCompanySalesTax;
                    $grouped->parent_id = $tax_rate->id;
                    $grouped->tax_rate_id = $id;
                    $grouped->save();
                }
            }
            $tax_rate->tax_rate = number_format(floatval(str_replace(',', '', $total_rate)),5);
            $tax_rate->save();
            $response = 'New Grouped Company Sales Tax Added';
            auth()->user()->store_activity('added grouped company sales tax - '.$tax_rate->name);
        } else {
            $response = 'New Company Sales Tax Added';
            auth()->user()->store_activity('added company sales tax - '.$tax_rate->name);
        }
        return redirect()->route('company-sales-taxes')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanySalesTax  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanySalesTax  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to edit.'));
        $company = Company::find(session('selected-company'));
        $company_locations = $company->locations;
        $tax_rate = CompanySalesTax::findOrFail($id);
        $countries = CountryCurrency::all();
        $company_vendors = $company->vendors->where('vendor_is_tax_agency',1);
        return view('v1.company-sales-taxes.edit')
            ->with('tax_rate',$tax_rate)
            ->with('countries',$countries)
            ->with('company_vendors',$company_vendors)
            ->with('company_locations',$company_locations);
    }

    public function editGrouped($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to edit.'));
        $company = Company::find(session('selected-company'));
        $company_locations = $company->locations;
        $tax_rate = CompanySalesTax::findOrFail($id);
        $countries = CountryCurrency::all();
        $company_vendors = $company->vendors->where('vendor_is_tax_agency',1);
        return view('v1.company-sales-taxes.edit-grouped')
            ->with('tax_rate',$tax_rate)
            ->with('countries',$countries)
            ->with('company_vendors',$company_vendors)
            ->with('company_locations',$company_locations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanySalesTax  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            '_location' => 'required',
            '_name' => 'required',
            '_tax_code' => 'required',
            '_country' => 'required',
            '_province_state' => 'required',
            '_tax_rate' => 'required_without:tax_rate_ids'
        ],['required_without'=>'Tax Rate is required']);
        $tax_rate = CompanySalesTax::findOrFail($id);
        if(strtolower($tax_rate->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company sales tax - '.$tax_rate->name);
        else
            auth()->user()->store_activity('updated company sales tax - '.$tax_rate->name.' to '.$request->_name);
        $tax_rate->tax_code = strtoupper($request->_tax_code);
        $tax_rate->location = $request->_location;
        $tax_rate->name = $request->_name;
        $tax_rate->province_state = $request->_province_state;
        $tax_rate->city = $request->_city;
        $tax_rate->tax_rate = $request->_tax_rate;
        $tax_rate->tax_agency = $request->_tax_agency;
        if($request->_start_date)
            $tax_rate->start_date = $request->_start_date.' 00:00:01';
        if($request->_end_date)
            $tax_rate->end_date = $request->_end_date.' 24:00:00';
        $tax_rate->save();
        if(count($request->tax_rate_ids)) {
            $tax_rate->grouped_tax_rates()->delete();
            $total_rate = 0;
            foreach($request->tax_rate_ids as $id) {
                if($id != 'all') {
                    $rate = CompanySalesTax::findOrFail($id);
                    $total_rate += $rate->tax_rate;
                    $grouped = new GroupedCompanySalesTax;
                    $grouped->parent_id = $tax_rate->id;
                    $grouped->tax_rate_id = $id;
                    $grouped->save();
                }
            }
            $tax_rate->tax_rate = number_format(floatval(str_replace(',', '', $total_rate)),5);
            $tax_rate->save();
            $response = 'Grouped Company Sales Tax Updated';
            auth()->user()->store_activity('updated grouped company sales tax - '.$tax_rate->name);
        } else {
            $response = 'Company Sales Tax Updated';
            auth()->user()->store_activity('updated company sales tax - '.$tax_rate->name);
        }
        return redirect()->route('company-sales-taxes')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanySalesTax  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-sales-taxes')->with('status', trans('You don\'t have permission to delete.'));
        $tax_rate = CompanySalesTax::findOrFail($id);
        if($tax_rate->company_chart_of_accounts->count())
            return redirect()->route('company-sales-taxes')->with('status', trans('Company Sales Tax used, cannot be deleted.'));
        auth()->user()->store_activity('deleted company sales tax - '.$tax_rate->name);
        $tax_rate->grouped_tax_rates()->delete();
        $tax_rate->delete();
        $response = 'Company Sales Tax Deleted';
        return redirect()->route('company-sales-taxes')->with('status',$response);
    }

    public function source(Request $request)
    {
        if($request->_id) {
            $test = CompanySalesTax::with(['state_province'=>function($query){
                    $query->with('country');
                }])->where('id','!=',$request->_id);
        } else {
            if($request->_type == 'add-group') {
                $test = CompanySalesTax::with(['state_province'=>function($query){
                    $query->with('country');
                }]);
            } else {
                $test = TaxRate::with(['state_province'=>function($query){
                    $query->with('country');
                }])->whereNotIn(DB::raw('(tax_code,name,province_state)'),function($query){
                    $query->select('tax_code','name','province_state')->from('company_sales_taxes')->where('company_id',session('selected-company'));
                });
            }
        }

        if($request->searchPhrase) {
            $gcoas = $test->where('id','like','%'.$request->searchPhrase.'%')->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get();
            $count = $test->where('id','like','%'.$request->searchPhrase.'%')->count();
        } else {
            $gcoas = $test->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get();
            $count = $test->count();
        }

        $request['rows'] = $gcoas;
        $request['total'] = $count;
        return $request;
    }
}
