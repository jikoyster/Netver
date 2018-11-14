<?php

namespace App\Http\Controllers\v1;

use App\CompanyTerm;
use App\Company;
use App\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyTermController extends Controller
{
    public function index($id = null)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company = Company::findOrFail(session('selected-company'));
        $company_terms = $company->terms;
        return view('v1.company-terms.index')
            ->with('company',$company)
            ->with('company_terms',$company_terms);
    }

    public function create()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('add'))
            return redirect()->route('company-terms')->with('status', trans('You don\'t have permission to add.'));
        return view('v1.company-terms.import');
    }

    public function import(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('company-terms')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        
        $test = new Term;

        if($request->term_ids) {
            foreach($request->term_ids as $id) {
                if($id != 'all') {
                    $gcoa = $test::findOrFail($id);
                    if(CompanyTerm::where('company_id',session('selected-company'))->where('name',$gcoa->name)->count() < 1) {
                        $company_term = new CompanyTerm;
                        $company_term->company_id = session('selected-company');
                        $company_term->name = $gcoa->name;
                        $company_term->standard = $gcoa->standard;
                        $company_term->data_driven = $gcoa->data_driven;
                        $company_term->net_due = $gcoa->net_due;
                        $company_term->discount = $gcoa->discount;
                        $company_term->discount_if_paid = $gcoa->discount_if_paid;
                        $company_term->inactive = $gcoa->inactive;
                        $company_term->save();
                        auth()->user()->store_activity('imported company term - '.$company_term->name);
                        $response[] = 'Imported '.$gcoa->name;
                    } else {
                        $response[] = $gcoa->name.' already imported';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('company-terms')->with('status',$response);
    }

    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('company-terms')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:company_terms',
            'standard_data_driven' => 'required'
        ],['standard_data_driven.required'=>'Standard / Data driven field must be chosen.']);
        $term = new CompanyTerm;
        $term->company_id = session('selected-company');
        $term->name = $request->name;
        $term->standard = $request->standard_data_driven == 0 ? 1 : 0;
        $term->data_driven = $request->standard_data_driven == 1 ? 1 : 0;
        $term->net_due = $request->standard_data_driven == 1 ? $request->net_due2 : $request->net_due1;
        $term->discount = $request->standard_data_driven == 1 ? $request->discount2 : $request->discount1;
        $term->discount_if_paid = $request->standard_data_driven == 1 ? $request->discount_if_paid2 : $request->discount_if_paid1;
        $term->inactive = $request->inactive ? 1 : 0;
        $term->save();
        $response = 'New Company Term Added';
        auth()->user()->store_activity('added company term - '.$term->name);
        return redirect()->route('company-terms')->with('status',$response);
    }

    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-terms')->with('status', trans('You don\'t have permission to edit.'));
        $company_term = CompanyTerm::findOrFail($id);
        return view('v1.company-terms.edit')
            ->with('company_term',$company_term);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-terms')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:company_terms,name,'.$id,
            'standard_data_driven' => 'required'
        ],['standard_data_driven.required'=>'Standard / Data driven field must be chosen.']);
        $company_term = CompanyTerm::findOrFail($id);
        if(strtolower($company_term->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company term - '.$company_term->name);
        else
            auth()->user()->store_activity('updated company term - '.$company_term->name.' to '.$request->name);
        $company_term->name = $request->name;
        $company_term->standard = $request->standard_data_driven == 0 ? 1 : 0;
        $company_term->data_driven = $request->standard_data_driven == 1 ? 1 : 0;
        $company_term->net_due = $request->standard_data_driven == 1 ? $request->net_due2 : $request->net_due1;
        $company_term->discount = $request->standard_data_driven == 1 ? $request->discount2 : $request->discount1;
        $company_term->discount_if_paid = $request->standard_data_driven == 1 ? $request->discount_if_paid2 : $request->discount_if_paid1;
        $company_term->inactive = $request->inactive ? 1 : 0;
        $company_term->save();
        $response = 'Updated Company Term';
        return redirect()->route('company-terms')->with('status',$response);
    }

    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-terms')->with('status', trans('You don\'t have permission to delete.'));
        $company_term = CompanyTerm::findOrFail($id);
        if($company_term->company_vendors->count())
            return redirect()->route('company-terms')->with('status', trans('Company Term used, cannot be deleted.'));
        auth()->user()->store_activity('deleted company term - '.$company_term->name);
        $company_term->delete();
        $response = 'Deleted';
        return redirect()->route('company-terms')->with('status',$response);
    }

    public function source(Request $request)
    {
        $test = Term::whereNotIn('name',CompanyTerm::where('company_id',session('selected-company'))->pluck('name'));

        if($request->searchPhrase) {
            $gcoas = $test->where('name','like','%'.$request->searchPhrase.'%')->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get();
            $count = $test->where('name','like','%'.$request->searchPhrase.'%')->count();
        } else {
            $gcoas = $test->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get();
            $count = $test->count();
        }

        $request['rows'] = $gcoas;
        $request['total'] = $count;
        return $request;
    }
}
