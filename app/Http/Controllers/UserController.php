<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DB;
use Hash;
use Session;
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
		$password = $req->input('password') ;
		$hashedPass = Hash::make($password) ;

		// echo $email."---".Hash::check($password, $hashedPass)."<br/>";
		
		$checklogin = DB::table('users')
				->select('*')
				->where(['email'=>$email])
				->get();
		
		// Session::put('email',$checklogin[0]->email);
		Session::put('loggedin_user',$checklogin[0]);
		$storedPw = $checklogin[0]->password;
		$passwordFlag = Hash::check($password, $storedPw);
		
		DB::table('users')
			->update(['remember_token' => $req->session()->get('_token')]);
		if(count($checklogin) > 0 && $passwordFlag == 1){
		// if( Auth::check() ){
			// echo "successful!";
			
			$_SESSION['email'] = DB::table('users')
					->select('email')
					->where(['email'=>$email, 'password'=>Hash::check('plain-text',$hashedPass)])
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
		$first_name = '';//$req->input('');
		$last_name = '';//$req->input('');
		$home_phone = '';//$req->input('');
		$mobile_phone = '';//$req->input('');
		$email = $req->input('email');
		$password = $req->input('password');
		$system_user_id = randomString();//$req->session()->get('_token');

		try
		{
			$id = DB::table('users')->insertGetId(
				[
					'fullname'			=> $fullname,
					'first_name'		=> $first_name,
					'last_name'			=> $last_name,
					'home_phone'		=> $home_phone,
					'mobile_phone'		=> $mobile_phone,
					'email' 			=> $email,
					'password'			=> Hash::make($password),
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


// random string generator
function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}