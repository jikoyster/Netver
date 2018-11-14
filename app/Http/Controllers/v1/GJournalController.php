<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\GJournal;
use App\Company;
use App\CompanyJournal;
use App\CompanySegment;
use App\JobProject;
use App\CompanyChartOfAccount;
use App\CompanyAccountSplitJournal;
use App\CompanyFiscalPeriod;

class GJournalController extends Controller
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
        if(!$company->fiscal_periods->count())
            return redirect()->route('company-fiscal-periods')->with('status','Please setup fiscal year period');
        $gjournals = $company->g_journals()->where('posted',null)->where('status',0)->get();
        $segments = $company->segments;
        $all_segments = CompanySegment::where('active',1)->get();
        $job_projects = $company->job_projects;
        $all_job_projects = JobProject::where('active',1)->get();
        $journals = $company->journals;
        $locations = $company->locations;
        $all_journals = CompanyJournal::all();
        $chart_of_accounts = $company->chart_of_accounts;
        $all_chart_of_accounts = CompanyChartOfAccount::all();
        return view('v1.g-journals.index')
            ->with('gjournals',$gjournals)
            ->with('segments',$segments)
            ->with('all_segments',$all_segments)
            ->with('job_projects',$job_projects)
            ->with('all_job_projects',$all_job_projects)
            ->with('journals',$journals)
            ->with('locations',$locations)
            ->with('all_journals',$all_journals)
            ->with('chart_of_accounts',$chart_of_accounts)
            ->with('all_chart_of_accounts',$all_chart_of_accounts)
            ->with('company',$company);
    }

    public function lists()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company = Company::find(session('selected-company'));
        $gjournal_lists = $company->g_journals()->with('_user')->where('status',1)->get()->unique('transaction_no');
        return view('v1.g-journals.lists')
            ->with('gjournal_lists',$gjournal_lists);
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
        $company = Company::find(session('selected-company'));
        Validator::extend('required_if_ok', function ($attribute, $value, $parameters, $validator) use ($request){
            return ($request->debit > 0 || $request->credit > 0) && ($request->debit != $request->credit) ? true:false;
        });
        Validator::extend('within_fiscal_year', function ($attribute, $value, $parameters, $validator) use ($request){
            $fiscal_period = CompanyFiscalPeriod::find(session('selected-company-fiscal-period')->id);
            return ($request->date <= $fiscal_period->end_date->format('Y-m-d') && $request->date >= $fiscal_period->start_date->format('Y-m-d')) ? true : false;
        });
        if($company->locations->where('active',1)->count())
            $fields['location'] = 'required';
        if($company->segments->where('active',1)->count())
            $fields['segment'] = 'required';
        $fields['description'] = 'required';
        $fields['date'] = 'required|within_fiscal_year';
        $fields['account'] = 'required';
        if($request->flag == 'true')
            $fields['note'] = 'required';
        $fields['debit'] = 'required_if_ok';
        $validator = $request->validate($fields,[
            'note.required'=>'Note is required',
            'required_if_ok'=>'Debit or Credit is required',
            'within_fiscal_year'=>'Date should be within fiscal year range'
        ]);
        if($request->description && $request->date) {
            $existing = $company->g_journals()->where('posted',null)->where('transaction_no',$request->trans_no)->get();
            //$existing = GJournal::where('posted',null)->where('transaction_no','like','%'.$request->transaction_no.'%');
            $test = new GJournal;
            $test->trans_line_no = $existing->count() ? $existing->last()->trans_line_no + 1 : 1;
            $test->company_key = $company->company_key;
            $test->journal = 'AJ';
            if($existing->count() < 1)
                $test->transaction_no = $request->trans_no;
            else
                $test->transaction_no = $existing->first()->transaction_no;
            //$test->transaction_no = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0x0fff ) | 0x4000, mt_rand( 0, 0x3fff ) | 0x8000, mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
            $test->description = $request->description;
            $test->date = $request->date;
            $test->location = $request->location;
            $test->account = $request->account;
            $test->segment = $request->segment;
            $test->flag = $request->flag == 'true' ? 1:0;
            $test->note = $request->note;
            $test->job_project = $request->job_project;
            $test->split_selected = $request->split_selected == 'true' ? 1:0;
            $test->user = auth()->user()->id;
            $test->amount = number_format(floatval(str_replace(',', '', $request->debit)) - floatval(str_replace(',', '', $request->credit)),5);
            $test->save();
            $test['total'] = $test->trans_line_no;
            return $test;
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $company = Company::find(session('selected-company'));
        Validator::extend('required_if_ok', function ($attribute, $value, $parameters, $validator) use ($request){
            return ($request->debit > 0 || $request->credit > 0) && ($request->debit != $request->credit) ? true:false;
        });
        Validator::extend('within_fiscal_year', function ($attribute, $value, $parameters, $validator) use ($request){
            $fiscal_period = CompanyFiscalPeriod::find(session('selected-company-fiscal-period')->id);
            return ($request->date <= $fiscal_period->end_date->format('Y-m-d') && $request->date >= $fiscal_period->start_date->format('Y-m-d')) ? true : false;
        });
        if($company->segments->where('active',1)->count())
            $fields['segment'] = 'required';
        $fields['description'] = 'required';
        $fields['date'] = 'required|within_fiscal_year';
        $fields['account'] = 'required';
        $fields['debit'] = 'required_if_ok';
        if($request->flag == 'true')
            $fields['note'] = 'required';
        $validator = $request->validate($fields,[
            'note.required'=>'Note is required',
            'required_if_ok'=>'Debit or Credit is required',
            'within_fiscal_year'=>'Date should be within fiscal year range'
        ]);
        if($request->id) {
            $test = GJournal::findOrFail($request->id);
            if($test->child($test->transaction_no,$test->trans_line_no)->count()) {
                $test->delete();
                return $test;
            }
            $test->description = $request->description;
            $test->date = $request->date;
            $test->account = $request->account;
            $test->amount = number_format(floatval(str_replace(',', '', $request->debit)) - floatval(str_replace(',', '', $request->credit)),5);
            $test->segment = $request->segment;
            $test->job_project = $request->job_project;
            $test->flag = $request->flag == 'true' ? 1:0;
            $test->note = $request->note;
            $test->modified_date_and_time = now();
            $test->save();
            $test->sibling()->update(['split_selected'=>$request->split_selected]);
            $test['total_debit'] = DB::table('g_journals')->where('company_key',$company->company_key)->where('posted',null)->where('amount','>=',0)->sum(DB::raw('replace(amount,",","")'));
            $test['total_credit'] = abs(DB::table('g_journals')->where('company_key',$company->company_key)->where('posted',null)->where('amount','<',0)->sum(DB::raw('replace(amount,",","")')));
            return $test;
        } else {
            return [];
        }
    }

    public function updateNew(Request $request)
    {
        $gjournal = GJournal::where('transaction_no',$request->transaction_no);
        if($gjournal->count()) {
            $gjournal->update(['status'=>1]);
            return redirect()->route('g-journals')->with('status','Transaction Saved');
        } else {
            return redirect()->route('g-journals');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $gjournal = GJournal::findOrFail($request->id);
        $transaction_no = $gjournal->transaction_no;
        $trans_line_no = $gjournal->trans_line_no;
        CompanyAccountSplitJournal::where('t_l_no',$gjournal->trans_line_no)->where('t_no',$gjournal->transaction_no)->delete();
        $gjournal->delete();
        $response = 'Deleted';
        return redirect()->route('g-journals')->with('status',$response);
    }

    public function destroyTransaction($transaction_no = 0)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if($transaction_no) {
            $gjournal = GJournal::where('transaction_no',$transaction_no)->delete();
            auth()->user()->store_activity('deleted transaction #'.$transaction_no);
            return redirect()->route('g-journal.lists')->with('status','Transaction Deleted');
        } else {
            return redirect()->route('g-journal.lists');
        }
    }

    private function updateTransLineNo($transaction_no,$trans_line_no)
    {
        $gjournal = GJournal::where('transaction_no',$transaction_no)->where('trans_line_no',($trans_line_no + 1))->first();
        if($gjournal) {
            $gjournal->trans_line_no = $trans_line_no;
            $gjournal->save();
            $this->updateTransLineNo($transaction_no,($trans_line_no + 1));
        }
    }

    public function post()
    {
        $company = Company::find(session('selected-company'));
        $company->g_journals()->where('posted',null)->update(['posted'=>now()]);
        return redirect()->route('g-journals');
    }

    public function reset(Request $request)
    {
        $company = Company::find(session('selected-company'));
        CompanyAccountSplitJournal::where('t_no',$request->transaction_no)->delete();
        $company->g_journals()->where('transaction_no',$request->transaction_no)->delete();
        return redirect()->route('g-journals');
    }
}