<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\CompanyAccountSplitJournal;
use App\Company;
use App\GJournal;
use App\CompanySegment;
use App\JobProject;

class CompanyAccountSplitJournalController extends Controller
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
        return view('v1.company-account-split-journals.index')
            ->with('all_journals',[])
            ->with('locations',$company->locations->where('active',2))
            ->with('gjournals',CompanyAccountSplitJournal::all())
            ->with('segments',$company->segments->where('active',2))
            ->with('job_projects',$company->job_projects->where('active',2))
            ->with('chart_of_accounts',$company->chart_of_accounts)
            ->with('company',$company);
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
        if($request->split_percent)
            $amount = str_replace(',', '', $request->amount_to_split) * ($request->split_percent / 100);
        else
            $amount = $request->split_amount;
        if($request->split_by == 1) {
            $gjournal = GJournal::where('trans_line_no',$request->t_l_no)->where('transaction_no',$request->t_no);
            Validator::extend('exceeds', function ($attribute, $value, $parameters, $validator) use ($request, $amount, $gjournal){
                $casj = CompanyAccountSplitJournal::where('t_no',$request->t_no)->where('t_l_no',$request->t_l_no);
                $casj->update(['amount_to_split'=>number_format(floatval(str_replace(',', '', $request->amount_to_split)),5)]);
                $total = str_replace(',','', number_format($casj->sum('split_amount'),5));
                if((($total + str_replace(',','',$amount)) == str_replace(',', '', $request->amount_to_split)))
                    $gjournal->update(['split_selected'=>2]);
                else
                    $gjournal->update(['split_selected'=>1]);
                return (($total + str_replace(',','',$amount)) > str_replace(',', '', $request->amount_to_split)) ? false : true;
            });
            $validator = $request->validate([
                'split_by'=>'required',
                'split_amount'=>'required_without:split_percent|exceeds',
                'amount_to_split'=>'required',
                'sub_account_no'=>'required',
            ],['exceeds'=>'Error: amount entered already above total.']);
            $existing = CompanyAccountSplitJournal::where('t_no',$request->t_no)->where('t_l_no',$request->t_l_no)->get();
            $account_split_journal = new CompanyAccountSplitJournal;
            $account_split_journal->line_no = $existing->count() ? $existing->last()->line_no + 1:1;
            $account_split_journal->company_key = $gjournal->first()->company_key;
            $account_split_journal->t_no = $request->t_no;
            if($existing->count())
                $account_split_journal->split_t_no = $existing->last()->split_t_no;
            else
                $account_split_journal->split_t_no = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0x0fff ) | 0x4000, mt_rand( 0, 0x3fff ) | 0x8000, mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
            $account_split_journal->t_l_no = $request->t_l_no;
            $account_split_journal->t_sign = $request->t_sign ? 'debit':'credit';
            $account_split_journal->amount_to_split = $request->amount_to_split;
            $account_split_journal->split_by = $request->split_by;
            /*$account_split_journal->split_amount_by = $request->split_amount_by;*/
            $account_split_journal->sub_account_no = $request->sub_account_no;
            if($request->split_amount_by == 1)
                $account_split_journal->split_amount = number_format(floatval(str_replace(',', '', $amount)),5);
            else
                $account_split_journal->split_amount = str_replace(',', '', $amount);
            $account_split_journal->note = $request->note;
            $account_split_journal->save();
            return $account_split_journal;
        } else {
            $gjournal_orig = GJournal::where('trans_line_no',$request->t_l_no)->where('transaction_no',$request->t_no);
            $gjournal_partners = GJournal::where('t_l_no',$request->t_l_no)->where('transaction_no',$request->t_no);
            if($gjournal_partners->count())
                $gjournal_orig = $gjournal_partners;
            Validator::extend('exceeds', function ($attribute, $value, $parameters, $validator) use ($request, $amount, $gjournal_orig){
                $casj = GJournal::where('transaction_no',$request->t_no)->where('t_l_no',$request->t_l_no);
                //$casj->update(['amount_to_split'=>number_format(floatval(str_replace(',', '', $request->amount_to_split)),5)]);
                $total = str_replace(',','', number_format($casj->sum('amount'),5));
                if((($total + str_replace(',','',$amount)) == str_replace(',', '', $request->amount_to_split)))
                    $gjournal_orig->update(['split_selected'=>2]);
                else
                    $gjournal_orig->update(['split_selected'=>1]);
                return (($total + str_replace(',','',$amount)) > str_replace(',', '', $request->amount_to_split)) ? false : true;
            });
            $validator = $request->validate([
                'split_by'=>'required',
                'split_amount'=>'required_without:split_percent',
                'amount_to_split'=>'required',
                'sub_account_no'=>'required',
            ],['exceeds'=>'Error: amount entered already above total.']);
            $existing = GJournal::where('transaction_no',$request->t_no)->where('t_l_no',$request->t_l_no)->get();
            $existing1 = GJournal::where('transaction_no',$request->t_no)->where('company_key',$gjournal_orig->first()->company_key)->get();
            $gjournal = new GJournal;

            $gjournal->company_key = $gjournal_orig->first()->company_key;
            $gjournal->date = $gjournal_orig->first()->date;
            $gjournal->description = $gjournal_orig->first()->description;
            $gjournal->account = $gjournal_orig->first()->account;
            $gjournal->journal = $gjournal_orig->first()->journal;
            $gjournal->location = $gjournal_orig->first()->location;
            $gjournal->flag = $gjournal_orig->first()->flag;
            $gjournal->index = $gjournal_orig->first()->index;
            $gjournal->user = auth()->user()->id;

            if($gjournal_orig->first()->original_amount_to_split)
                $gjournal->split_id_no = $gjournal_orig->first()->split_id_no;
            else
                $gjournal->split_id_no = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0x0fff ) | 0x4000, mt_rand( 0, 0x3fff ) | 0x8000, mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
            //$gjournal->split_id_no = $gjournal_orig->first()->original_amount_to_split ? $gjournal_orig->first()->split_id_no : $gjournal_orig->first()->id;

            $gjournal->original_amount_to_split = $gjournal_orig->first()->original_amount_to_split ? $gjournal_orig->first()->original_amount_to_split : $gjournal_orig->first()->amount;
            $gjournal->split_selected = $gjournal_orig->first()->split_selected;

            $gjournal->trans_line_no = $existing1->count() ? $existing1->last()->trans_line_no + 1:1;
            $gjournal->line_no = $existing1->count() ? $existing1->last()->line_no + 1:1;
            $gjournal->transaction_no = $request->t_no;
            if($gjournal_orig->first()->original_amount_to_split)
                $gjournal->t_l_no = $gjournal_orig->first()->t_l_no;
            else
                $gjournal->t_l_no = $gjournal_orig->first()->trans_line_no;
            $gjournal->amount = $request->t_sign ? number_format(floatval(str_replace(',', '', $amount)),5):number_format(floatval(0 - str_replace(',', '', $amount)),5);
            if($request->split_by == 2) {
                $segment = CompanySegment::find($request->sub_account_no);
                $gjournal->segment = $segment->name;
                $gjournal->job_project = $gjournal_orig->first()->job_project;
            } elseif($request->split_by == 3) {
                $job_project = JobProject::find($request->sub_account_no);
                $gjournal->job_project = $job_project->name;
                $gjournal->segment = $gjournal_orig->first()->segment;
            }
            $gjournal->note = $request->note;
            $gjournal->save();
            return $gjournal;
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
        $orig = GJournal::find($request->id);
        $split_percent = $request->split_percent < 0 ? $request->split_percent : ($request->split_percent);
        if($split_percent)
            $amount = str_replace(',', '', $request->amount_to_split) * ($split_percent / 100);
        else
            $amount = $request->split_amount;
        if($request->splitby == 1) {
            Validator::extend('exceeds', function ($attribute, $value, $parameters, $validator) use ($request, $amount){
                $orig = CompanyAccountSplitJournal::find($request->id);
                $casj = CompanyAccountSplitJournal::where('id','!=',$request->id)->where('t_no',$orig->t_no)->where('t_l_no',$orig->t_l_no);
                $casj->update(['amount_to_split' => number_format(floatval(str_replace(',', '', $request->amount_to_split)),5)]);
                $total = str_replace(',','', number_format($casj->sum('split_amount'),5));
                $gjournal = GJournal::where('trans_line_no',$orig->t_l_no)->where('transaction_no',$orig->t_no);
                if((($total + str_replace(',','',$amount)) == str_replace(',', '', $request->amount_to_split)))
                    $gjournal->update(['split_selected'=>2]);
                else
                    $gjournal->update(['split_selected'=>1]);
                return (($total + str_replace(',','',$amount)) > str_replace(',', '', $request->amount_to_split)) ? false : true;
            });
            $validator = $request->validate([
                'split_amount'=>'required_without:split_percent|exceeds',
                'amount_to_split'=>'required',
                'sub_account_no'=>'required',
            ],['exceeds'=>'Error: amount entered already above total.']);
            if($request->id) {
                $account_split_journal = CompanyAccountSplitJournal::find($request->id);
                if($account_split_journal->split_by == 1)
                    $account_split_journal->load('account_split_item');
                elseif($account_split_journal->split_by == 2)
                    $account_split_journal->load('segment');
                elseif($account_split_journal->split_by == 3)
                    $account_split_journal->load('job_project');
                $account_split_journal->amount_to_split = $request->amount_to_split;
                $account_split_journal->sub_account_no = $request->sub_account_no;
                if($request->split_amount_by == 1)
                    $account_split_journal->split_amount = number_format(floatval(str_replace(',', '', $amount)),5);
                else
                    $account_split_journal->split_amount = number_format(floatval(str_replace(',', '', $amount)),5);
                $account_split_journal->note = $request->note;
                $account_split_journal->save();
                return $account_split_journal;
            } else {
                return [];
            }
        } else {
            Validator::extend('exceeds', function ($attribute, $value, $parameters, $validator) use ($request, $amount, $orig){
                $casj = GJournal::where('id','!=',$request->id)->where('transaction_no',$orig->transaction_no)->where('t_l_no',$orig->t_l_no);
                //$casj->update(['amount' => number_format(floatval(str_replace(',', '', $request->amount_to_split)),5)]);
                $total = str_replace(',','', number_format($casj->sum('amount'),5));
                $gjournal = GJournal::where('t_l_no',$orig->t_l_no)->where('transaction_no',$orig->transaction_no);
                if((abs(number_format(abs($total) + str_replace(',','',$amount),5)) == abs(str_replace(',', '', $request->amount_to_split))))
                    $gjournal->update(['split_selected'=>2]);
                else
                    $gjournal->update(['split_selected'=>1]);
                return (abs(number_format($total + str_replace(',','',$amount),5)) > abs(str_replace(',', '', $request->amount_to_split))) ? false : true;
            });
            $validator = $request->validate([
                'split_amount'=>'required_without:split_percent',
                'amount_to_split'=>'required',
                'sub_account_no'=>'required',
            ],['exceeds'=>'Error: amount entered already above total.']);
            if($request->id) {
                $account_split_journal = GJournal::find($request->id);
                if($account_split_journal->split_by == 2) {
                    $account_split_journal->load('segment');
                    $account_split_journal->segment = $request->sub_account_no;
                } elseif($account_split_journal->split_by == 3) {
                    $account_split_journal->load('job_project');
                    $account_split_journal->job_project = $request->sub_account_no;
                }
                //$account_split_journal->amount_to_split = $request->amount_to_split;
                if($request->split_amount_by == 1)
                    $account_split_journal->amount = number_format(floatval(str_replace(',', '', $amount)),5);
                else {
                    $orig_amt = $account_split_journal->parent ? $account_split_journal->parent->amount : $account_split_journal->original_amount_to_split;
                    $account_split_journal->amount = $orig_amt >= 0 ? number_format(floatval(str_replace(',', '', $amount)),5):number_format(floatval(str_replace(',', '', 0 - $amount)),5);;
                }
                $account_split_journal->note = $request->note;
                $account_split_journal->save();
                return $account_split_journal;
            } else {
                return [];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$splitby)
    {
        if(!auth()->user()->can('delete'))
            $response = 'You don\'t have permission to delete.';
        if($splitby != 1)
            $account_split_journal = GJournal::findOrFail($id);
        else
            $account_split_journal = CompanyAccountSplitJournal::findOrFail($id);
        //auth()->user()->store_activity('deleted company account map - '.$account_split_journal->name);
        $account_split_journal->delete();
        $response = 'Deleted';
        return $response;
    }

    public function post()
    {
        //
    }

    public function reset(Request $request)
    {
        //
    }

    public function accountSplitJournals($transaction_no = 0, $transaction_line_no = 0, $account_no = 0)
    {
        $company = Company::find(session('selected-company'));
        $chart_of_account = $company->chart_of_accounts->where('account_no',$account_no)->first();
        //$data['split_items'] = $company->account_split_items()->where('account_no',$chart_of_account->id)->get();
        $gjournals = GJournal::with('parent')->with('_segment')->with('_job_project')->where('transaction_no',$transaction_no)->where('t_l_no',$transaction_line_no)->get();
        $gjournal = GJournal::where('transaction_no',$transaction_no)->where('trans_line_no',$transaction_line_no)->first();
        $gjournal_partners = GJournal::with('parent')->with('_segment')->with('_job_project')->where('transaction_no',$transaction_no)->where('t_l_no',$gjournal->t_l_no)->get();

        if(!$gjournals->count() && $gjournal_partners->first()->split_id_no)
            $gjournals=$gjournal_partners;
        if($gjournals->count())
            $data['split_journals'] = $gjournals;
        else
            $data['split_journals'] = CompanyAccountSplitJournal::with('account_split_item')->with('segment')->with('job_project')->where('t_no',$transaction_no)->where('t_l_no',$transaction_line_no)->get();
        $data['split_selected'] = GJournal::where('trans_line_no',$transaction_line_no)->where('transaction_no',$transaction_no)->first()->split_selected;
        return $data;
    }

    public function subAccount($id = 0, $account_no)
    {
        $company = Company::find(session('selected-company'));
        if($id == 1) {
            $chart_of_account = $company->chart_of_accounts->where('account_no',$account_no)->first();
            $data['split_items'] = $company->account_split_items()->where('account_no',$chart_of_account->id)->get();
        } elseif($id == 2) {
            $data['split_items'] = $company->segments()->get();
        } elseif($id == 3) {
            $data['split_items'] = $company->job_projects()->get();
        } else {
            $data['split_items'] = [];
        }
        return $data;
    }
}
