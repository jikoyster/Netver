<?php

namespace App\Http\Controllers\v1;

use App\CompanySegment;
use App\CompanyLocation;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanySegmentController extends Controller
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
        $company_locations = $company->locations;
        return view('v1.company-segments.index')
            ->with('company',$company)
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
            return redirect()->route('company-segments')->with('status', trans('You don\'t have permission to add.'));

        $validator = $request->validate([
            'cs_id' => 'required|unique:company_segments',
            'name' => 'required|unique:company_segments',
            'location' => 'required'
        ]);
        $company_segment = new CompanySegment;
        $company_segment->company_id = session('selected-company');
        $company_segment->cs_id = $request->cs_id;
        $company_segment->name = $request->name;
        $company_segment->parent_id = $request->parent_id;
        $company_segment->location = $request->location;
        $company_segment->description = $request->description;
        $company_segment->index = $request->index ? 1:0;
        $company_segment->active = $request->active ? 1:0;
        $company_segment->has_children = $request->has_children ? 1:0;
        $company_segment->save();
        $response = 'Company Segment Added';
        auth()->user()->store_activity('added company segment - '.$company_segment->name);
        return redirect()->route('company-segments')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanySegment  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanySegment  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-segments')->with('status', trans('You don\'t have permission to edit.'));
        $company_segment = CompanySegment::findOrFail($id);
        $company_locations = CompanyLocation::where('company_id',session('selected-company'))->get();
        return view('v1.company-segments.edit')
            ->with('company_segment',$company_segment)
            ->with('company_locations',$company_locations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanySegment  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-segments')->with('status', trans('You don\'t have permission to edit.'));

        $validator = $request->validate([
            'cs_id' => 'required|unique:company_segments,cs_id,'.$id,
            'name' => 'required|unique:company_segments,name,'.$id,
            'location' => 'required'
        ]);
        $company_segment = CompanySegment::findOrFail($id);
        if(strtolower($company_segment->name) == strtolower($request->name))
            auth()->user()->store_activity('updated company segment - '.$company_segment->name);
        else
            auth()->user()->store_activity('updated company segment - '.$company_segment->name.' to '.$request->name);
        $company_segment->cs_id = $request->cs_id;
        $company_segment->name = $request->name;
        $company_segment->parent_id = $request->parent_id;
        $company_segment->location = $request->location;
        $company_segment->description = $request->description;
        $company_segment->index = $request->index ? 1:0;
        $company_segment->active = $request->active ? 1:0;
        $company_segment->has_children = $request->has_children ? 1:0;
        $company_segment->save();
        $response = 'Company Segment Updated';
        return redirect()->route('company-segments')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanySegment  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-segments')->with('status', trans('You don\'t have permission to delete.'));
        $company_segment = CompanySegment::findOrFail($id);
        if($company_segment->children->count() || $company_segment->g_journals->count())
            return redirect()->route('company-segments')->with('status','Company Segment Used, cannot be deleted.');
        auth()->user()->store_activity('deleted company segment - '.$company_segment->name);
        $company_segment->delete();
        $response = 'Company Segment Deleted';
        return redirect()->route('company-segments')->with('status',$response);
    }
}
