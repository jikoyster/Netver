<?php
use Illuminate\Http\Request;

//modifying login operation
Route::get('/', function(Request $request){	
	$session = $request->input();

	if( isset($_SESSION['email']) ){
	// if(Session::get('email') != null ){
		return redirect("/dashboard");
	}else{
		return view("login");
	}	
});

// login - signup
Route::any('/L08!n', 'UserController@login');
// Route::get('/L08!n', 'UserController@login');
Route::post('/S!8nU9', 'UserController@signup');
Route::get('/S!8nU9', 'UserController@signup');

Route::any('/logout', function(){
	Session::flush();
	unset($_SESSION);
	session_destroy();
	return redirect("/");
});
// Route::get('/logout', function(){});

if( isset($_SESSION['email']) ){

Route::get('/dashboard', "DashboardController@index");
// Route::get('/advisors/login', "AdvisorsController@login");

Route::get('/profile', function(){
	if( isset($_SESSION['email']) ){
		return view("profile");
	}else{
		return redirect("/login");
	}
});
// change this to /profile/change-password
Route::get('/change-password', "UserController@index"); 



// security
Route::get('/system-setup/{subpage}', 'SecurityController@subpage');
Route::get('/system-setup', 'SecurityController@index');

// clients
Route::get('/clients', function(){
	$clients = DB::table('companies')			
				->leftJoin('company_user', 'company_user.company_id', '=', 'companies.id')
				->where('companies.company_type','client')
				->get();
	return view('client-index', ['clients' => $clients]);
});

// accountants
Route::get('/accountants', function(){
	$accountants = DB::table('companies')			
				// ->leftJoin('designations', 'designations.id', '=', 'companies.multi_currency')
				->leftJoin('country_currencies', 'country_currencies.id', '=', 'companies.country')
				->where('companies.company_type','accounting')
				->get();
	return view('accountant-index', ['accountants' => $accountants]);
});

// reports
Route::get('/ui-reports', function(){
	$reports = DB::table('ui_reports')->get();
	return view('ui-reports', ['reports' => $reports]);
});

}//session

// ERROR ROUTES
Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);

/*Route::get('/register-accountant', function () {
		return view('home-accountant');
});*/

// Route::get('/', function () {
// 	if(request()->server('SERVER_NAME') == 'sysacc.netver.niel' || request()->server('SERVER_NAME') == 'sysacc.netver.com')
// 		return redirect('home');
// 	else
// 		/*return view('home-accountant');*/

// 		// return view("advisors-login");
// 		return view("home");
// });

Route::get('/sample', function(){
    return view('sample');
});