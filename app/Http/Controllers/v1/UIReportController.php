<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\UIReport;

class UIReportController extends Controller
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
        $ui_reports = UIReport::all();
        $ui_not_resolved_reports = UIReport::where('status','!=','Resolved')->get();
        return view('v1.ui-reports.index')
            ->with('ui_reports',$ui_reports)
            ->with('ui_not_resolved_reports',$ui_not_resolved_reports);
    }

    public function dataByStatus($status)
    {
        if($status)
            $ui_reports = UIReport::where('status',$status)->get();
        else
            $ui_reports = UIReport::all();
        $resolved = $status == 'Resolved' ? 'resolved':'index';
        return view('v1.ui-reports.'.$resolved.'-table')
            ->with('ui_reports',$ui_reports);
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
        $validator = $request->validate([
            'issue' => '',
            'url' => 'required'
        ]);
        $ui_report = new UIReport;
        $ui_report->issue = $request->issue ?: '';
        $ui_report->priority = $request->priority ?: 3;
        $ui_report->url = $request->url;
        $ui_report->page = str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($request->url)));
        $ui_report->status = $request->status ?: 'Outstanding';
        if($request->status == 'Resolved') {
            $ui_report->resolved_by = auth()->user()->id;
            $ui_report->resolved_at = now();
            $ui_report->resolved_status = '-status-resolved-';
        } else {
            $ui_report->resolved_status = '-status-not-resolved-';
        }
        $ui_report->company_id = auth()->user()->companies->count() ? auth()->user()->companies->first()->id : 0;
        $ui_report->user_id = auth()->user()->id;
        $ui_report->save();
        auth()->user()->store_activity('added errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id);
        $response = 'UI Report Saved';
        return redirect()->route('ui-reports')->with('status',$response);
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
        if(!auth()->user()->can('edit'))
            return redirect()->route('ui-reports')->with('status', trans('You don\'t have permission to edit.'));
        $ui_report = UIReport::findOrFail($id);
        return view('v1.ui-reports.edit')
            ->with('ui_report',$ui_report);
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
            return redirect()->route('ui-reports')->with('status', trans('You don\'t have permission to edit.'));
        $ui_report = UIReport::findOrFail($id);
        $ui_report->priority = $request->priority ?: 3;
        $ui_report->status = $request->status ?: 'Outstanding';
        if($request->status == 'Resolved') {
            $ui_report->resolved_by = auth()->user()->id;
            $ui_report->resolved_at = now();
            $ui_report->resolved_status = '-status-resolved-';
            auth()->user()->store_activity('updated errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id.' - resolved');
        } else {
            $ui_report->resolved_status = '-status-not-resolved-';
            auth()->user()->store_activity('updated errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id.' - not resolved');
        }
        $ui_report->save();
        $response = 'UI Report Updated!';
        return redirect()->route('ui-reports')->with('status',$response);
    }

    public function updateType(Request $request)
    {
        if($request->id) {
            $ui_report = UIReport::findOrFail($request->ui_report_id);
            $data['id'] = $ui_report->id;
            if($request->type == 'priority') {
                $ui_report->priority = $request->id;
                $ui_report->save();
                $data['val'] = $ui_report->priority > 1 ? $ui_report->priority == 2 ? 'Medium' : 'Low' : 'High';
                auth()->user()->store_activity('updated errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id.' - '.$data['val'].' Priority');
            } else if($request->type == 'status') {
                $ui_report->status = $request->id;
                if($request->id == 'Resolved') {
                    $ui_report->resolved_by = auth()->user()->id;
                    $ui_report->resolved_at = now();
                    $ui_report->resolved_status = '-status-resolved-';
                    auth()->user()->store_activity('updated errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id.' - resolved');
                } else {
                    $ui_report->resolved_status = '-status-not-resolved-';
                    auth()->user()->store_activity('updated errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id.' - not resolved');
                }
                $ui_report->save();
                $data['val'] = $ui_report->status;
            }
            return $data;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('ui-reports')->with('status', trans('You don\'t have permission to delete.'));
        $ui_report = UIReport::findOrFail($id);
        auth()->user()->store_activity('deleted errors and bugs report from page "'.$ui_report->page.'" #'.$ui_report->id);
        $ui_report->delete();
        $response = 'UI Report Deleted';
        return redirect()->route('ui-reports')->with('status',$response);
    }

    public function ajaxData(Request $request)
    {
        $model = new UIReport;

        if($request->searchPhrase) {
            $priority_pos = strpos("@highmediumlow",$request->searchPhrase) ?:'false';
            if($priority_pos >= 1 && $priority_pos <= 4)
                $priority = 1;
            elseif($priority_pos >= 5 && $priority_pos <= 10)
                $priority = 2;
            elseif($priority_pos > 10)
                $priority = 3;
            else
                $priority = $request->searchPhrase;
            $ui_reports = $model
                ->where('issue','like','%'.$request->searchPhrase.'%')
                ->orWhere('status','like','%'.$request->searchPhrase.'%')
                ->orWhere('id','like','%'.$request->searchPhrase.'%')
                ->orWhere('url','like','%'.$request->searchPhrase.'%')
                ->orWhere('priority','like','%'.$priority.'%')
                ->orWhere('resolved_status','like','%'.$request->searchPhrase.'%')
                ->take($request->rowCount)
                ->skip(($request->rowCount * $request->current) - $request->rowCount)
                ->get()->load(['user']);
            $count = $model
                ->where('issue','like','%'.$request->searchPhrase.'%')
                ->orWhere('status','like','%'.$request->searchPhrase.'%')
                ->orWhere('id','like','%'.$request->searchPhrase.'%')
                ->orWhere('url','like','%'.$request->searchPhrase.'%')
                ->orWhere('priority','like','%'.$priority.'%')
                ->orWhere('resolved_status','like','%'.$request->searchPhrase.'%')
                ->count();
        } else {
            $ui_reports = $model
                ->take($request->rowCount)
                ->skip(($request->rowCount * $request->current) - $request->rowCount)
                ->get()->load(['user']);
            $count = $model->count();
        }

        $request['rows'] = $ui_reports;
        $request['total'] = $count;

        return $request;
    }
}
