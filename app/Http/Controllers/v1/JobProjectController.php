<?php

namespace App\Http\Controllers\v1;

use App\JobProject;
use App\JobProjectStatusHistory;
use App\CompanyLocation;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobProjectController extends Controller
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
        $job_project_parents = JobProject::where('company_id',session('selected-company'))->where('has_a_child',1)->get();
        $company_locations = $company->locations;
        return view('v1.job-projects.index')
            ->with('company',$company)
            ->with('job_project_parents',$job_project_parents)
            ->with('company_locations',$company_locations);
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
            return redirect()->route('job-projects')->with('status', trans('You don\'t have permission to add.'));

        Validator::extend('location_required', function ($attribute, $value, $parameters, $validator) {
            $hasLocation = CompanyLocation::where('company_id',session('selected-company'))->count() ? false : true;
            return (!$hasLocation && !$value) ? false : true;
        });
        Validator::extend('job_project_id_unique', function ($attribute, $value, $parameters, $validator) use ($request) {
            return JobProject::where('jp_id',$request->jp_id)->where('company_id',session('selected-company'))->count() ? false : true;
        });
        Validator::extend('job_project_name_unique', function ($attribute, $value, $parameters, $validator) use ($request) {
            return JobProject::where('name',$request->name)->where('active',1)->count() ? false : true;
        });
        $validator = $request->validate([
            'jp_id' => 'required|job_project_id_unique',
            'name' => 'required|job_project_name_unique',
            'location' => 'location_required'
        ],[
            'location_required' => 'Location is required',
            'job_project_id_unique' => 'Job / Project ID Added',
            'job_project_name_unique' => 'Job / Project Name Added and is Active'
        ]);
        $job_project = new JobProject;
        $job_project->company_id = session('selected-company');
        $job_project->jp_id = $request->jp_id;
        $job_project->name = $request->name;
        $job_project->parent = $request->parent;
        $job_project->location = $request->location;
        $job_project->description = $request->description ?: '';
        $job_project->index = $request->index ? 1:0;
        $job_project->has_a_child = $request->has_a_child ? 1:0;
        $job_project->active = $request->active ? 1:0;
        $job_project->save();
        $response = 'Job / Project Added';
        auth()->user()->store_activity('added job / project - '.$job_project->name);
        return redirect()->route('job-projects')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobProject  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobProject  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('job-projects')->with('status', trans('You don\'t have permission to edit.'));
        $job_project = JobProject::findOrFail($id);
        $job_project_parents = JobProject::where('company_id',session('selected-company'))->where('id','!=',$id)->where('has_a_child',1)->get();
        $company_locations = CompanyLocation::where('company_id',session('selected-company'))->get();
        return view('v1.job-projects.edit')
            ->with('job_project',$job_project)
            ->with('job_project_parents',$job_project_parents)
            ->with('company_locations',$company_locations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobProject  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('job-projects')->with('status', trans('You don\'t have permission to edit.'));

        Validator::extend('location_required', function ($attribute, $value, $parameters, $validator) {
            $hasLocation = CompanyLocation::where('company_id',session('selected-company'))->count() ? false : true;
            return (!$hasLocation && !$value) ? false : true;
        });
        Validator::extend('job_project_id_unique', function ($attribute, $value, $parameters, $validator) use ($request,$id) {
            return JobProject::where('id','!=',$id)->where('jp_id',$request->jp_id)->where('company_id',session('selected-company'))->count() ? false : true;
        });
        Validator::extend('job_project_name_unique', function ($attribute, $value, $parameters, $validator) use ($request,$id) {
            return JobProject::where('id','!=',$id)->where('name',$request->name)->where('active',1)->count() ? false : true;
        });
        $validator = $request->validate([
            'jp_id' => 'required|job_project_id_unique',
            'name' => 'required|job_project_name_unique',
            'location' => 'location_required'
        ],[
            'location_required' => 'Location is required',
            'job_project_id_unique' => 'Job / Project ID Added',
            'job_project_name_unique' => 'Job / Project Name Added and is Active'
        ]);
        $job_project = JobProject::findOrFail($id);
        if(strtolower($job_project->name) == strtolower($request->name))
            auth()->user()->store_activity('updated job / project - '.$job_project->name);
        else
            auth()->user()->store_activity('updated job / project - '.$job_project->name.' to '.$request->name);
        $job_project->jp_id = $request->jp_id;
        $job_project->name = $request->name;
        $job_project->parent = $request->parent;
        $job_project->location = $request->location;
        $job_project->description = $request->description ?: '';
        $job_project->index = $request->index ? 1:0;
        $job_project->has_a_child = $request->has_a_child ? 1:0;
        $active1 = $job_project->active ? 1:0;
        $active2 = $request->active ? 1:0;
        if($active1 != $active2) {
            if($request->active)
                $this->activate($id);
            else
                $this->deactivate($id);
        }
        $job_project->active = $request->active ? 1:0;
        $job_project->save();
        $response = 'Job Project Updated';
        return redirect()->route('job-projects')->with('status',$response);
    }

    public function activate($id)
    {
        $job_project = JobProject::findOrFail($id);
        $job_project_status = new JobProjectStatusHistory;
        $job_project_status->activated = 1;
        $job_project->job_project_status_histories()->save($job_project_status);
    }

    public function deactivate($id)
    {
        $job_project = JobProject::findOrFail($id);
        $job_project_status = new JobProjectStatusHistory;
        $job_project_status->activated = 0;
        $job_project->job_project_status_histories()->save($job_project_status);
    }

    public function statusActivity($id)
    {
        $activities = JobProject::findOrFail($id)->job_project_status_histories->sortByDesc('id');
        return view('v1.activated-status-histories.index')->with('activities',$activities);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobProject  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('job-projects')->with('status', trans('You don\'t have permission to delete.'));
        $job_project = JobProject::findOrFail($id);
        if($job_project->job_project_child->count() || $job_project->g_journals->count())
            return redirect()->route('job-projects')->with('status','Cannot Delete - Used.');
        auth()->user()->store_activity('deleted job / project - '.$job_project->name);
        $job_project->job_project_status_histories()->delete();
        $job_project->delete();
        $response = 'Job / Project Deleted';
        return redirect()->route('job-projects')->with('status',$response);
    }
}
