<?php

namespace App\Http\Controllers\v1;

use App\TaxRate;
use App\GroupedTaxRate;
use App\CountryCurrency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxRateController extends Controller
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
        $tax_rates = TaxRate::with('grouped_tax_rates')->get();
        $countries = CountryCurrency::all();
        return view('v1.tax-rates.index')
            ->with('tax_rates',$tax_rates)
            ->with('countries',$countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('tax-rates')->with('status', trans('You don\'t have permission to add.'));
        $countries = CountryCurrency::all();
        return view('v1.tax-rates.add-grouped')
            ->with('countries',$countries);
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
            return redirect()->route('tax-rates')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            '_name' => 'required',
            '_tax_code' => 'required',
            '_country' => 'required',
            '_province_state' => 'required',
            '_tax_rate' => 'required_without:tax_rate_ids'
        ]);
        $tax_rate = new TaxRate;
        $tax_rate->tax_code = strtoupper($request->_tax_code);
        $tax_rate->name = $request->_name;
        $tax_rate->province_state = $request->_province_state;
        $tax_rate->city = $request->_city;
        $tax_rate->tax_rate = $request->_tax_rate;
        /*$tax_rate->start_date = $request->_start_date;
        $tax_rate->end_date = $request->_end_date;*/
        $tax_rate->save();
        if(count($request->tax_rate_ids)) {
            $total_rate = 0;
            foreach($request->tax_rate_ids as $id) {
                if($id != 'all') {
                    $rate = TaxRate::findOrFail($id);
                    $total_rate += $rate->tax_rate;
                    $grouped = new GroupedTaxRate;
                    $grouped->parent_id = $tax_rate->id;
                    $grouped->tax_rate_id = $id;
                    $grouped->save();
                }
            }
            $tax_rate->tax_rate = number_format(floatval(str_replace(',', '', $total_rate)),5);
            $tax_rate->save();
            $response = 'New Grouped Tax Rate Added';
            auth()->user()->store_activity('added grouped tax rate - '.$tax_rate->name);
        } else {
            $response = 'New Tax Rate Added';
            auth()->user()->store_activity('added tax rate - '.$tax_rate->name);
        }
        return redirect()->route('tax-rates')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaxRate  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaxRate  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('tax-rates')->with('status', trans('You don\'t have permission to edit.'));
        $tax_rate = TaxRate::findOrFail($id);
        $countries = CountryCurrency::all();
        return view('v1.tax-rates.edit')
            ->with('tax_rate',$tax_rate)
            ->with('countries',$countries);
    }

    public function editGrouped($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('tax-rates')->with('status', trans('You don\'t have permission to edit.'));
        $tax_rate = TaxRate::findOrFail($id);
        $countries = CountryCurrency::all();
        return view('v1.tax-rates.edit-grouped')
            ->with('tax_rate',$tax_rate)
            ->with('countries',$countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxRate  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('tax-rates')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            '_name' => 'required',
            '_tax_code' => 'required',
            '_country' => 'required',
            '_province_state' => 'required',
            '_tax_rate' => 'required_without:tax_rate_ids'
        ]);
        $tax_rate = TaxRate::findOrFail($id);
        if(strtolower($tax_rate->name) == strtolower($request->name))
            auth()->user()->store_activity('updated tax rate - '.$tax_rate->name);
        else
            auth()->user()->store_activity('updated tax rate - '.$tax_rate->name.' to '.$request->_name);
        $tax_rate->tax_code = strtoupper($request->_tax_code);
        $tax_rate->name = $request->_name;
        $tax_rate->province_state = $request->_province_state;
        $tax_rate->city = $request->_city;
        $tax_rate->tax_rate = $request->_tax_rate;
        /*$tax_rate->start_date = $request->_start_date;
        $tax_rate->end_date = $request->_end_date;*/
        $tax_rate->save();
        if(count($request->tax_rate_ids)) {
            $tax_rate->grouped_tax_rates()->delete();
            $total_rate = 0;
            foreach($request->tax_rate_ids as $id) {
                if($id != 'all') {
                    $rate = TaxRate::findOrFail($id);
                    $total_rate += $rate->tax_rate;
                    $grouped = new GroupedTaxRate;
                    $grouped->parent_id = $tax_rate->id;
                    $grouped->tax_rate_id = $id;
                    $grouped->save();
                }
            }
            $tax_rate->tax_rate = number_format(floatval(str_replace(',', '', $total_rate)),5);
            $tax_rate->save();
            $response = 'Grouped Tax Rate Updated';
            auth()->user()->store_activity('updated grouped tax rate - '.$tax_rate->name);
        } else {
            $response = 'Tax Rate Updated';
            auth()->user()->store_activity('updated tax rate - '.$tax_rate->name);
        }
        return redirect()->route('tax-rates')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxRate  $tax_rate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('tax-rates')->with('status', trans('You don\'t have permission to delete.'));
        $tax_rate = TaxRate::findOrFail($id);
        auth()->user()->store_activity('deleted tax rate - '.$tax_rate->name);
        $tax_rate->grouped_tax_rates()->delete();
        $tax_rate->delete();
        $response = 'Tax Rate Deleted';
        return redirect()->route('tax-rates')->with('status',$response);
    }

    public function source(Request $request)
    {
        //$test = TaxRate::whereNotIn('id',CompanyJournal::where('company_id',session('selected-company'))->pluck('journalid'));
        if($request->_id)
            $test = TaxRate::where('id','!=',$request->_id);
        else
            $test = new TaxRate;
        $load = ['state_province'=>function($query){
            $query->with('country');
        }];

        if($request->searchPhrase) {
            $gcoas = $test->where('tax_code','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get()->load($load);
            $count = $test->where('tax_code','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->count();
        } else {
            $gcoas = $test->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get()->load($load);
            $count = $test->count();
        }

        $request['rows'] = $gcoas;
        $request['total'] = $count;
        return $request;
    }
}
