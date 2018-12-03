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

use app\User;


class UserController extends BaseController{
	public function index(){
		return view('pf-change-password');
	}

	//
	public function login(Request $req){
		$email = $req->input('email');
		$password = $req->input('password') ;
		$hashedPass = Hash::make($password) ;

		// echo $email."---".Hash::check($password, $hashedPass)."<br/>";
		
		$checklogin = DB::table('users')
				->select('*')
				->where(['email'=>$email])
				->get();
		
		Session::put('email',$checklogin[0]->email);

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
		$fullname = ''; //$req->input('fullname');
		$first_name = $req->input('first_name');
		$last_name = $req->input('last_name');
		$home_phone = '';//$req->input('');
		$mobile_phone = '';//$req->input('');
		$email = $req->input('email');
		$password = $req->input('password');
		$system_user_id = $this->randomString();//$req->session()->get('_token');

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
			echo $e;
		}
	}

	//
	public function profile(){
		if( isset($_SESSION['email']) ){
			$loggedin_user_email = Session::get('email');
			if(isset($loggedin_user_email))
				return view("doctracc.profile.profile")->with('users', $this->get_user_info($loggedin_user_email));
			else{
				session_destroy();
				redirect("/");
			}
				
		}else{
			return redirect("/");
		}
	}

	//
	private function get_user_info($email){
		$the_user = DB::table('users')
							->select('*')
							->where(['email' => $email])
							->get();
		return $the_user;
	}

	// random string generator
	private function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}




	//profile subpages
	public function profileAction($subpage){
		switch($subpage){
			case 'saveUser':
				$id				= $_REQUEST['id'];
				$email 			= $_REQUEST['email'];
				$first_name		= $_REQUEST['first_name'];
				$last_name 		= $_REQUEST['last_name'];
				$home_phone		= $_REQUEST['home_phone'];
				$mobile_phone 	= $_REQUEST['mobile_phone'];
				
				DB::table('users')
					->where('system_user_id', '=',$id)
					->update([
							'first_name'	=> $first_name,
							'last_name'		=> $last_name,
							'home_phone'	=> $home_phone,
							'mobile_phone'	=> $mobile_phone
							]);
				break;
			case 'changePassword':
				$id				= $_REQUEST['id'];
				$old_password	= $_REQUEST['old_password'];
				$new_password	= $_REQUEST['new_password'];

				$hashed_password = '';
				//get password 
				$saved_hashed_password = DB::table('users')
											->select('password')
											->where('system_user_id',$id)
											->get();

				foreach($saved_hashed_password as $key => $data)
						$hashed_password = $data->password;

				// compare pw: check if password(fromDB) == $_REQUEST['password']
				if( Hash::check($old_password, $hashed_password) ){
					// update table('users'): 'password' => Hash::make('password')
					
					DB::table('users')
					->where('system_user_id', '=',$id)
					->update([
							'password'	=> Hash::make($new_password),
							]);
					echo "success";
				}else{
					echo "error";
				}

				

				break;
			default: 
				break;
		}
	}// end function: profileAction


	//end of class
}