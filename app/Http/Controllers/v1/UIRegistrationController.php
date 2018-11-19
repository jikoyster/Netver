<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\UIRegistration;

class UIRegistrationController extends Controller
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
        $uis = UIRegistration::all();
        return view('v1.ui-registrations.index')
            ->with('uis',$uis);
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
        Validator::extend('ui_registration_unique', function ($attribute, $value, $parameters, $validator) {
            $str = $this->param_remover($value);
            return UIRegistration::where('url',$str)->count() ? false : true;
        });
        $validator = $request->validate([
            'ui_url' => 'required|ui_registration_unique'
        ],['ui_registration_unique'=>'UI already registered']);
        $ui_ctr = UIRegistration::count() ? UIRegistration::all()->last()->id : 0;
        $ui = new UIRegistration;
        $ui->name = 'UI-'.++$ui_ctr;
        $ui->url = $this->param_remover($request->ui_url);
        $ui->save();
        $response = 'New UI Registered';
        return redirect()->route('ui-registrations')->with('status',$response);
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
            return redirect()->route('ui-registrations')->with('status', trans('You don\'t have permission to edit.'));
        $ui = UIRegistration::findOrFail($id);
        return view('v1.ui-registrations.edit')
            ->with('ui',$ui);
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
            return redirect()->route('ui-registrations')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'name' => 'required'
        ]);

        $ui = UIRegistration::findOrFail($id);
        $ui->name = $request->name;
        $ui->save();

        $response = 'UI Updated';
        return redirect()->route('ui-registrations')->with('status', $response);
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
            return redirect()->route('ui-registrations')->with('status', trans('You don\'t have permission to delete.'));
        UIRegistration::destroy($id);
        $response = 'UI Registration Deleted!';
        return redirect()->route('ui-registrations')->with('status', trans($response));
    }

    public function param_remover($value = '')
    {
        $str = str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($value)));
        $explode_str = explode('/edit/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/edit/':$explode_str[0];
        $explode_str = explode('/menu-elements/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/menu-elements/':$explode_str[0];
        $explode_str = explode('/edit-element/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/edit-element/':$explode_str[0];
        $explode_str = explode('/state-province/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/state-province/':$explode_str[0];
        $explode_str = explode('menus/data/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'menus/data/':$explode_str[0];
        $explode_str = explode('password/reset/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'password/reset/':$explode_str[0];
        $explode_str = explode('register-confirm/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'register-confirm/':$explode_str[0];
        $explode_str = explode('/state-provinces/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/state-provinces/':$explode_str[0];
        $explode_str = explode('/profile/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/profile/':$explode_str[0];
        $explode_str = explode('/users/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/users/':$explode_str[0];
        $explode_str = explode('/features/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/features/':$explode_str[0];
        $explode_str = explode('/permissions/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/permissions/':$explode_str[0];
        $explode_str = explode('menus/roles/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'menus/roles/':$explode_str[0];
        $explode_str = explode('/edit-role/',$str);
        $str = count($explode_str) > 1 ? $explode_str[0].'/edit-role/':$explode_str[0];
        return $str;
    }
}
