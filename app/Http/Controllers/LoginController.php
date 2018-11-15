<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DB;

class LoginController extends BaseController
{
	public function login(Request $req)
	{
		$email = $req->input('email');
		$password = $req->input('password');

		// echo $email."---".$password;

		$checklogin = DB::table('users')->where(['email'=>$email, 'password'=>$password])->get();
		if(count($checklogin) > 0){
			// echo "successful!";
			return view('profile');
		}else{
			return view('/login');
		}

	}
    //
}
