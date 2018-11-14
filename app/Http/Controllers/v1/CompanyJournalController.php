<?php

namespace App\Http\Controllers\v1;

use App\CompanyJournal;
use App\Company;
use App\MapGroup;
use App\Journal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyJournalController extends Controller
{
    public function index($id = null)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company = Company::findOrFail(session('selected-company'));
        $company_journals = $company->journals;
        return view('v1.company-journals.index')
            ->with('company',$company)
            ->with('company_journals',$company_journals);
    }

    public function create()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('add'))
            return redirect()->route('company-journals')->with('status', trans('You don\'t have permission to add.'));
        return view('v1.company-journals.import');
    }

    public function import(Request $request)
    {
    	//return $request;
        if(!auth()->user()->can('add'))
            return redirect()->route('company-journals')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        
        $test = new Journal;

        if($request->journal_ids) {
            foreach($request->journal_ids as $id) {
                if($id != 'all') {
                    $gcoa = $test::findOrFail($id);
                    if(CompanyJournal::where('company_id',session('selected-company'))->where('journalid',$gcoa->id)->count() < 1) {
                        $company_journal = new CompanyJournal;
                        $company_journal->company_id = session('selected-company');
                        $company_journal->journalid = $gcoa->id;
                        $company_journal->name = $gcoa->name;
                        $company_journal->description = $gcoa->description;
                        $company_journal->journal_index = $gcoa->journal_index ? 1:0;
                        $company_journal->show_debit_credit = $gcoa->show_debit_credit ? 1:0;
                        $company_journal->journal_active = $gcoa->journal_active ? 1:0;
                        $company_journal->save();
                        auth()->user()->store_activity('imported company journal - '.$company_journal->name);
                        $response[] = 'Imported '.$gcoa->map_no.'-'.$gcoa->name;
                    } else {
                        $response[] = $gcoa->map_no.'-'.$gcoa->name.' already imported';
                    }
                }
            }
        } else {
            $response = '';
        }
        return redirect()->route('company-journals')->with('status',$response);
    }

    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('company-journals')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'journalid' => 'required|unique:company_journals',
            'name' => 'required|unique:company_journals',
            'description' => ''
        ]);
        $journal = new CompanyJournal;
        $journal->company_id = session('selected-company');
        $journal->journalid = strtoupper($request->journalid);
        $journal->name = $request->name;
        $journal->description = $request->description;
        $journal->journal_index = $request->journal_index ? 1 : 0;
        $journal->show_debit_credit = $request->show_debit_credit ? 1 : 0;
        $journal->journal_active = $request->journal_active ? 1 : 0;
        $journal->save();
        $response = 'New Company Journal Added';
        auth()->user()->store_activity('added company journal - '.$journal->name);
        return redirect()->route('company-journals')->with('status',$response);
    }

    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-journals')->with('status', trans('You don\'t have permission to edit.'));
        $company_journal = CompanyJournal::findOrFail($id);
        return view('v1.company-journals.edit')
            ->with('company_journal',$company_journal);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-journals')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);
        $company_journal = CompanyJournal::findOrFail($id);
        if(strtolower($company_journal->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company journal - '.$company_journal->name);
        else
            auth()->user()->store_activity('updated company journal - '.$company_journal->name.' to '.$request->name);
        $company_journal->journalid = strtoupper($request->journalid);
        $company_journal->name = $request->name;
        $company_journal->description = $request->description;
        $company_journal->journal_index = $request->journal_index ? 1:0;
        $company_journal->show_debit_credit = $request->show_debit_credit ? 1:0;
        $company_journal->journal_active = $request->journal_active ? 1:0;
        $company_journal->save();
        $response = 'Updated Company Journal';
        return redirect()->route('company-journals')->with('status',$response);
    }

    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-journals')->with('status', trans('You don\'t have permission to delete.'));
        $company_journal = CompanyJournal::findOrFail($id);
        auth()->user()->store_activity('deleted company journal - '.$company_journal->name);
        $company_journal->delete();
        $response = 'Deleted';
        return redirect()->route('company-journals')->with('status',$response);
    }

    public function source(Request $request)
    {
        $test = Journal::whereNotIn('id',CompanyJournal::where('company_id',session('selected-company'))->pluck('journalid'));

        if($request->searchPhrase) {
            $gcoas = $test->where('description','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get();
            $count = $test->where('description','like','%'.$request->searchPhrase.'%')->orWhere('name','like','%'.$request->searchPhrase.'%')->count();
        } else {
            $gcoas = $test->take($request->rowCount)->skip(($request->rowCount * $request->current) - $request->rowCount)->get();
            $count = $test->count();
        }

        $request['rows'] = $gcoas;
        $request['total'] = $count;
        return $request;
    }
}
