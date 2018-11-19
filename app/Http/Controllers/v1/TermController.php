<?php

namespace App\Http\Controllers\v1;

use App\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
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
        $terms = Term::all();
        return view('v1.terms.index')
            ->with('terms',$terms);
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
            return redirect()->route('terms')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:terms',
            'standard_data_driven' => 'required'
        ],['standard_data_driven.required'=>'Standard / Data driven field must be chosen.']);
        $term = new Term;
        $term->name = $request->name;
        $term->standard = $request->standard_data_driven == 0 ? 1 : 0;
        $term->data_driven = $request->standard_data_driven == 1 ? 1 : 0;
        $term->net_due = $request->standard_data_driven == 1 ? $request->net_due2 : $request->net_due1;
        $term->discount = $request->standard_data_driven == 1 ? $request->discount2 : $request->discount1;
        $term->discount_if_paid = $request->standard_data_driven == 1 ? $request->discount_if_paid2 : $request->discount_if_paid1;
        $term->inactive = $request->inactive ? 1 : 0;
        $term->save();
        $response = 'New Term Added';
        auth()->user()->store_activity('added term - '.$term->name);
        return redirect()->route('terms')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $Term
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $Term
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('terms')->with('status', trans('You don\'t have permission to edit.'));
        $term = Term::findOrFail($id);
        return view('v1.terms.edit')
            ->with('term',$term);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $Term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('terms')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required|unique:terms,name,'.$id,
            'standard_data_driven' => 'required'
        ],['standard_data_driven.required'=>'Standard / Data driven field must be chosen.']);
        $term = Term::findOrFail($id);
        if(strtolower($term->name) == strtolower($request->name))
            auth()->user()->store_activity('updated term - '.$term->name);
        else
            auth()->user()->store_activity('updated term - '.$term->name.' to '.$request->name);
        $term->name = $request->name;
        $term->standard = $request->standard_data_driven == 0 ? 1 : 0;
        $term->data_driven = $request->standard_data_driven == 1 ? 1 : 0;
        $term->net_due = $request->standard_data_driven == 1 ? $request->net_due2 : $request->net_due1;
        $term->discount = $request->standard_data_driven == 1 ? $request->discount2 : $request->discount1;
        $term->discount_if_paid = $request->standard_data_driven == 1 ? $request->discount_if_paid2 : $request->discount_if_paid1;
        $term->inactive = $request->inactive ? 1 : 0;
        $term->save();
        $response = 'Term Updated';
        return redirect()->route('terms')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $Term
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('terms')->with('status', trans('You don\'t have permission to delete.'));
        $term = Term::findOrFail($id);
        auth()->user()->store_activity('deleted term - '.$term->name);
        $term->delete();
        $response = 'Term Deleted';
        return redirect()->route('terms')->with('status',$response);
    }
}
