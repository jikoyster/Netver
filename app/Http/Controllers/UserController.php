<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DB;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

use Auth;

class UserController extends BaseController
{
	public function index(){
		return view('pf-change-password');
	}

	public function login(Request $req){
		$email = $req->input('email');
		$password = $req->input('password');

		// echo $email."---".$password."<br/>";



		$checklogin = DB::table('users')->where(['email'=>$email, 'password'=>sha1(md5($password))])->get();
		DB::table('users')
			->update(['remember_token' => $req->session()->get('_token')]);

		if(count($checklogin) > 0){
		// if( Auth::check() ){
			// echo "successful!";
			
			$_SESSION['email'] = DB::table('users')
					->select('email')
					->where(['email'=>$email, 'password'=>sha1(md5($password))])
					->get();
			
			echo "success";
			// return redirect('/dashboard');
		}else{
			echo "error";
			// return redirect('/');
		}

	}//END: LOGIN

	public function signup(Request $req){
		$fullname = $req->input('fullname');
		$last_name = '';//$req->input('');
		$home_phone = '';//$req->input('');
		$mobile_phone = '';//$req->input('');
		$email = $req->input('email');
		$password = $req->input('password');
		$system_user_id = $req->session()->get('_token');

		try
		{
			$id = DB::table('users')->insertGetId(
				[
					'fullname'		=> $fullname,
					'last_name'			=> $last_name,
					'home_phone'		=> $home_phone,
					'mobile_phone'		=> $mobile_phone,
					'email' 			=> $email,
					'password'			=> sha1(md5($password)),
					'system_user_id' 	=> $system_user_id
				]
			);

			echo "success";
		}catch(QueryException $e){
			echo "error";
		}
	}
    //
}
