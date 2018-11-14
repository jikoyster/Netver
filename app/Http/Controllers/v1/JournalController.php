<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Journal;

class JournalController extends Controller
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
        $journals = Journal::all();
        return view('v1.journals.index')
            ->with('journals',$journals);
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
            return redirect()->route('journals')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'journalid' => 'required|unique:journals',
            'name' => 'required|unique:journals',
            'description' => ''
        ]);
        $journal = new Journal;
        $journal->journalid = strtoupper($request->journalid);
        $journal->name = $request->name;
        $journal->description = $request->description;
        $journal->journal_index = $request->journal_index ? 1 : 0;
        $journal->show_debit_credit = $request->show_debit_credit ? 1 : 0;
        $journal->journal_active = $request->journal_active ? 1 : 0;
        $journal->save();
        $response = 'New Journal Added';
        auth()->user()->store_activity('added journal - '.$journal->name);
        return redirect()->route('journals')->with('status',$response);
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
            return redirect()->route('journals')->with('status', trans('You don\'t have permission to edit.'));
        $journal = Journal::findOrFail($id);
        return view('v1.journals.edit')
            ->with('journal',$journal);
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
            return redirect()->route('journals')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'journalid' => 'required|unique:journals,journalid,'.$id,
            'name' => 'required|unique:journals,name,'.$id,
            'description' => ''
        ]);
        $journal = Journal::findOrFail($id);
        if(strtolower($journal->name) == strtolower($request->name))
            auth()->user()->store_activity('updated journal - '.$journal->name);
        else
            auth()->user()->store_activity('updated journal - '.$journal->name.' to '.$request->name);
        $journal->journalid = strtoupper($request->journalid);
        $journal->name = $request->name;
        $journal->description = $request->description;
        $journal->journal_index = $request->journal_index ? 1 : 0;
        $journal->show_debit_credit = $request->show_debit_credit ? 1 : 0;
        $journal->journal_active = $request->journal_active ? 1 : 0;
        $journal->save();
        $response = 'Account Journal Updated';
        return redirect()->route('journals')->with('status',$response);
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
            return redirect()->route('journals')->with('status', trans('You don\'t have permission to delete.'));
        $journal = Journal::findOrFail($id);
        auth()->user()->store_activity('deleted journal - '.$journal->name);
        $journal->delete();
        $response = 'Journal Deleted';
        return redirect()->route('journals')->with('status',$response);
    }
}
