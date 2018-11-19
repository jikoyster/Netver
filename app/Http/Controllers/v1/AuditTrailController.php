<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuditTrail;

class AuditTrailController extends Controller
{
    public function index()
    {
    	if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message','Your Role is not allowed.');
    	$audit_trails = AuditTrail::all()->take(-100);
    	return view('v1.audit-trails.index')
    		->with('audit_trails',$audit_trails);
    }
}
