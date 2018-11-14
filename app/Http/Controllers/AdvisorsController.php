<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorsController extends Controller
{
	public function index(){
		return view("advisors-index");
	}

	public function login(){
		return view("advisors-login");
	}
    //END OF CLASS
}
