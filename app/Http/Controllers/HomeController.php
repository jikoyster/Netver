<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Company;
use App\TestAcct;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('selected-company');
        session()->forget('selected-company-fiscal-period');
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        //return Auth::user()->roles;
        /*$role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit articles']);*/
        //return User::permission('access to administration sites')->get();
        //return Permission::where('name','edit articles')->get();
        //Auth::user()->givePermissionTo('access to administration sites');
        //Auth::user()->assignRole('admin');
        
        /*$role = Role::find(1);
        $role->givePermissionTo('access to administration sites');*/
        
        //return Auth::user()->hasPermissionTo('edit articles') ? 'yes':'no';
        $companies = auth()->user()->companies;
        return view('home')
            ->with('companies',$companies)
            ->with('name',Auth::user()->name);
    }

    public function selectCompanyIndex()
    {
        $companies = auth()->user()->hasRole('super admin') ? Company::all() : auth()->user()->companies;
        return view('home-select-company')
            ->with('companies',$companies)
            ->with('name',Auth::user()->name);
    }

    public function selectCompany(Request $request)
    {
        $company = Company::findOrFail($request->company_id);
        session(['selected-company'=>$request->company_id]);
        return redirect()->route('select-company')->with('status',$company->trade_name.' Selected');
    }

    public function accountantIndex()
    {
        return view('home-accountant');
    }

    public function testing()
    {
        $test_accts = TestAcct::all();
        return view('v1.testing.index')
            ->with('test_accts',$test_accts);
    }

    public function test_accts(Request $request)
    {
        //return $request->callback;
        $data = ['page'=>$request->page];
        $data['rows'] = TestAcct::take($request->rows)
            ->skip(($request->rows * $request->page) - $request->rows)
            ->get();
        $data['total'] = TestAcct::count();
        $data['records'] = ceil($data['total'] / $request->rows);
        return $request->callback."(".json_encode($data).")";
    }

    public function test_accts_post(Request $request)
    {
        return $request;
    }
}
