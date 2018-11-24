<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DB;

use Auth;

class LoginController extends BaseController
{
	public function bk_login(Request $req){
		$email = $req->input('email');
		$password = $req->input('password');

		// echo $email."---".$password."<br/>";

		$checklogin = DB::table('users')->where(['email'=>$email, 'password'=>md5($password)])->get();
		DB::table('users')
			->update(['remember_token' => $req->session()->get('_token')]);

		if(count($checklogin) > 0){
		// if( Auth::check() ){
			// echo "successful!";
			
			$_SESSION['email'] = DB::table('users')
					->select('email')
					->where(['email'=>$email, 'password'=>md5($password)])
					->get();
			
			echo "success";
			// return redirect('/dashboard');
		}else{
			echo "error";
			// return redirect('/');
		}
	}



	public function login(Request $req){
		$email = $req->input('email');
		$password = $req->input('password');

		// echo $email."---".$password."<br/>";

		$checklogin = DB::table('users')->where(['email'=>$email, 'password'=>md5($password)])->get();
		DB::table('users')
			->update(['remember_token' => $req->session()->get('_token')]);

		if(count($checklogin) > 0){
		// if( Auth::check() ){
			// echo "successful!";
			
			$_SESSION['email'] = DB::table('users')
					->select('email')
					->where(['email'=>$email, 'password'=>md5($password)])
					->get();
			echo "ok";
			

			return redirect('/dashboard');
		}else{
			echo "not";
			return redirect('/');
		}

	}

	public function logout(){
		DB::table('users')
			->update(['remember_token' => '']);

		Auth::logout();
		return redirect('/profile');
	}

	public function checkForLoginUser(){

	}

    //
}
