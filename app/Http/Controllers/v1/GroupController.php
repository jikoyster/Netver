<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Group;

class GroupController extends Controller
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
        $groups = Group::all();
        return view('v1.groups.index')
            ->with('groups',$groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home');
        return view('v1.groups.add');
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
            return redirect()->route('groups')->with('status', trans('You don\'t have permission to add.'));
        $validator = $request->validate([
            'name' => 'required|unique:groups,name',
        ]);

        $group = new Group;
        $group->name = ucwords(strtolower($request->name));
        $group->save();

        auth()->user()->store_activity('added group - '.$group->name);
        $response = 'New Group Added!';

        return redirect()->route('groups')->with('status', trans($response));
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
            return redirect()->route('groups')->with('status', trans('You don\'t have permission to edit.'));
        $group = Group::findOrFail($id);
        return view('v1.groups.edit')
            ->with('group',$group);
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
        if(!auth()->user()->can('delete'))
            return redirect()->route('groups')->with('status', trans('You don\'t have permission to delete.'));
        $validator = $request->validate([
            'name' => 'required|unique:groups,name,'.$id
        ]);

        $group = Group::findOrFail($id);
        if($id < 4) {
            $response = '"'.ucwords($group->name).'" Group Cannot be Updated.';
        } else {
            auth()->user()->store_activity('updated group - '.$group->name.' to '.strtolower($request->name));
            $group->name = ucwords(strtolower($request->name));
            $group->save();
            $response = 'Group Updated!';
        }

        return redirect()->route('groups')->with('status', trans($response));
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
            return redirect()->route('groups')->with('status', trans('You don\'t have permission to delete.'));
        $group = Group::find($id);
        if($id < 4) {
            $response = '"'.ucwords($group->name).'" Cannot be Deleted.';
        } else {
            if($group->users->count() || $group->menu_sets->count()) {
                $response = '"'.ucwords($group->name).'" is used, Cannot be Deleted.';
            } else {
                auth()->user()->store_activity('deleted group - '.$group->name);
                $group->delete();
                $response = 'Group Deleted!';
            }
        }

        return redirect()->route('groups')->with('status', trans($response));
    }
}
