<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Trade;

class TradeController extends Controller
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
        $trades = Trade::where('company_id',session('selected-company'))->get();
        return view('v1.trades.index')
            ->with('trades',$trades);
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
            return redirect()->route('trades')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => [
                'required',
                Rule::unique('trades')->where(function ($query) {
                    return $query->where('company_id', session('selected-company'));
                })
            ],
            'description' => 'required'
        ]);
        $trade = new Trade;
        $trade->company_id = session('selected-company');
        $trade->name = $request->name;
        $trade->description = $request->description;
        $trade->save();
        $response = 'New Trade Added';
        auth()->user()->store_activity('added trade - '.$trade->name);
        return redirect()->route('trades')->with('status',$response);
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
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('trades')->with('status', trans('You don\'t have permission to edit.'));
        $trade = Trade::findOrFail($id);
        return view('v1.trades.edit')
            ->with('trade',$trade);
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
            return redirect()->route('trades')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => [
                'required',
                Rule::unique('trades')->where(function ($query) use ($id) {
                    return $query->where('id','!=',$id)->where('company_id', session('selected-company'));
                })
            ],
            'description' => 'required'
        ]);
        $trade = Trade::findOrFail($id);
        if(strtolower($trade->name) == strtolower($request->name))
            auth()->user()->store_activity('updated trade - '.$trade->name);
        else
            auth()->user()->store_activity('updated trade - '.$trade->name.' to '.$request->name);
        $trade->name = $request->name;
        $trade->description = $request->description;
        $trade->save();
        $response = 'Trade Updated';
        return redirect()->route('trades')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('trades')->with('status', trans('You don\'t have permission to delete.'));
        $trade = Trade::findOrFail($id);
        if($trade->company_vendors->count())
            return redirect()->route('trades')->with('status','Trade used, cannot be deleted');
        auth()->user()->store_activity('deleted trade - '.$trade->name);
        $trade->delete();
        $response = 'Trade Deleted';
        return redirect()->route('trades')->with('status',$response);
    }
}
