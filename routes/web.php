<?php
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
session_start();
 
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

//modifying login operation
Route::get('/', function(Request $request){	
	$session = $request->input();

	// echo "adfsda: ";
	// print_r($_SESSION['email']);

	// if($session){
	if( isset($_SESSION['email']) ){
		return redirect("/dashboard");
	}else{
		return view("login");
	}	
});

Route::post('/login', 'LoginController@login');
Route::post('/logout', function(){
	session_destroy();

	return redirect("/");
});

Route::get('/ui-reports', function(){

	$reports = DB::table('ui_reports')->get();

	return view('ui-reports', ['reports' => $reports]);
});


// accountants
Route::get('/accountants', 'AccountantController@index');


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

Route::group(['middleware'=>'auth'], function(){
	Route::get('country/state-province/{id}','v1\CountryController@showStateProvince')->name('country.state');
	Route::get('country/map-group/{id?}','v1\CountryController@showMapGroups')->name('country.map-groups');
	Route::get('field-informations/table-column/{id?}','v1\TableColumnDescriptionController@showTableColumn')->name('field-information.table-columns');
	Route::get('national-chart-of-accounts/country/{id?}','v1\NationalChartOfAccountController@showNCA')->name('country.nca');
});


if(request()->server('SERVER_NAME') == 'sysacc.netver.niel' || request()->server('SERVER_NAME') == 'sysacc.netver.com') {
	Route::get('test-accts', 'TestingController@test_accts')->name('test-accts');
	Route::group(['middleware'=>'auth'], function(){
		Route::get('home', 'HomeController@index')->name('home');
		/*Route::get('select-company', 'HomeController@selectCompanyIndex')->name('select-company');
		Route::post('select-company', 'HomeController@selectCompany')->name('select-company.save');*/
		Route::get('testing', 'HomeController@testing')->name('testing');
		Route::post('testing', 'HomeController@test_accts_post');
		
		Route::post('test-store', 'TestingController@store')->name('test-store');
		Route::post('test-update', 'TestingController@update')->name('test-update');
		Route::post('test-delete', 'TestingController@destroy')->name('test-delete');
		Route::get('test-post', 'TestingController@post')->name('test-post');
		Route::get('menus/data/{id}','v1\MenuController@dataByGroup032618');
	});
}
else {
	Route::group(['middleware'=>'guest'], function(){
		Route::get('home', 'HomeController@accountantIndex')->name('home');
	});
}


if(request()->server('SERVER_NAME') == 'sysacc.netver.niel' || request()->server('SERVER_NAME') == 'sysacc.netver.com') {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('logout', 'v1\UserController@user_logout');
	Route::post('register', 'Auth\RegisterController@register')->name('register');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');

	Route::get('password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::get('register/confirm/{token}/{email}', 'Auth\RegisterController@showConfirmForm')->name('register.confirm');
	Route::post('register/confirm', 'Auth\RegisterController@confirm')->name('register.confirmed');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::group(['prefix'=>'ui-registrations'], function(){
		Route::post('','v1\UIRegistrationController@store');
	});

	Route::group(['prefix'=>'ui-reports'], function(){
		Route::post('','v1\UIReportController@store');
	});

	Route::group(['middleware'=>'auth'], function(){

		Route::post('invite', 'v1\UserController@invite')->name('invite');
		Route::get('invite', 'v1\UserController@showInvitationForm');
		Route::get('audit-trails','v1\AuditTrailController@index')->name('audit-trails');

		Route::group(['prefix'=>'country'], function(){
			Route::get('','v1\CountryController@index')->name('country');
			Route::post('','v1\CountryController@store')->name('country.save');
			Route::get('/add','v1\CountryController@create')->name('country.add');
			Route::get('/edit/{id}','v1\CountryController@edit')->name('country.edit');
			Route::post('/edit/{id}','v1\CountryController@update');
			Route::get('/delete/{id}','v1\CountryController@destroy')->name('country.delete');
			Route::get('state-provinces/{id}','v1\CountryController@stateProvinces')->name('country.state-provinces');
		});

		Route::get('accountants','v1\CompanyController@accountants')->name('accounting-companies');
		Route::group(['prefix'=>'companies'], function(){
			Route::get('','v1\CompanyController@lists')->name('companies');
			Route::post('','v1\CompanyController@store')->name('company.save');
			Route::get('/add','v1\CompanyController@create')->name('company.add');
			Route::get('/edit/{id}','v1\CompanyController@edit')->name('company.edit');
			Route::post('/edit/{id}','v1\CompanyController@update');
			Route::get('/delete/{id}','v1\CompanyController@destroy')->name('company.delete');
			Route::get('address/{id}','v1\CompanyController@address')->name('accounting-companies.address');
			Route::post('address/{id}','v1\CompanyController@updateAdd');
			Route::get('select-company/{id}','v1\CompanyController@selectCompany');
			Route::get('close-company/{id}','v1\CompanyController@clearCompany')->name('clear-company');

			Route::get('profile/{segment2?}/{id?}','v1\CompanyController@index')->name('accountant-company.profile');
			Route::get('accounting-profile/{id}','v1\CompanyController@accountantProfile')->name('accountant-company.edit');
			Route::post('profile/{segment2?}/{id?}','v1\CompanyController@accountantUpdateProfile');
			Route::get('profile/{acct_no}','v1\CompanyController@index')->name('company.index');
			Route::get('company-address/{acct_no?}','v1\CompanyController@companyAddress')->name('company.address');
			Route::post('company-address/{acct_no?}','v1\CompanyController@updateCompanyAddress');
			Route::post('/company-profile/{id}','v1\CompanyController@updateCompany')->name('company-profile.edit');
			
			Route::get('businesses','v1\CompanyController@lists')->name('company.businesses');
			Route::post('businesses','v1\CompanyController@store');

			Route::get('users/{company_id}','v1\CompanyController@users')->name('company.users');
			Route::post('users/{company_id}','v1\CompanyController@storeUser');
			Route::get('users/delete/{company_id}/{id}','v1\CompanyController@destroyUser')->name('company.user.delete');
		});

		Route::group(['prefix'=>'field-informations'], function(){
			Route::get('','v1\TableColumnDescriptionController@index')->name('field-informations');
			Route::post('','v1\TableColumnDescriptionController@store');
			Route::get('/add','v1\TableColumnDescriptionController@create')->name('field-information.add');
			Route::get('/edit/{id}','v1\TableColumnDescriptionController@edit')->name('field-information.edit');
			Route::post('/edit/{id}','v1\TableColumnDescriptionController@update');
			Route::get('/delete/{id}','v1\TableColumnDescriptionController@destroy')->name('field-information.delete');
		});

		Route::group(['prefix'=>'state-province'], function(){
			Route::get('','v1\StateCountryController@index')->name('state-province');
			Route::post('','v1\StateCountryController@store');
			Route::get('/add','v1\StateCountryController@create')->name('state-province.add');
			Route::get('/edit/{id}','v1\StateCountryController@edit')->name('state-province.edit');
			Route::post('/edit/{id}','v1\StateCountryController@update');
			Route::get('/delete/{id}','v1\StateCountryController@destroy')->name('state-province.delete');
		});

		Route::group(['prefix'=>'ui-registrations'], function(){
			Route::get('','v1\UIRegistrationController@index')->name('ui-registrations');
			Route::get('/add','v1\UIRegistrationController@create')->name('ui-registration.add');
			Route::get('/edit/{id}','v1\UIRegistrationController@edit')->name('ui-registration.edit');
			Route::post('/edit/{id}','v1\UIRegistrationController@update');
			Route::get('/delete/{id}','v1\UIRegistrationController@destroy')->name('ui-registration.delete');
		});

		Route::group(['prefix'=>'ui-reports'], function(){
			Route::get('','v1\UIReportController@index')->name('ui-reports');
			Route::get('/add','v1\UIReportController@create')->name('ui-report.add');
			Route::get('/edit/{id}','v1\UIReportController@edit')->name('ui-report.edit');
			Route::post('/edit/{id}','v1\UIReportController@update');
			Route::get('/delete/{id}','v1\UIReportController@destroy')->name('ui-report.delete');
			Route::post('update','v1\UIReportController@updateType')->name('ui-report.update');

			Route::get('data/{id}','v1\UIReportController@dataByStatus');
			Route::post('ajax-data','v1\UIReportController@ajaxData')->name('ui-report.ajax-data');
		});

		Route::group(['prefix'=>'features'], function(){
			Route::get('','v1\FeatureController@index')->name('features');
			Route::post('','v1\FeatureController@store')->name('feature.save');
			Route::get('/add','v1\FeatureController@create');
			Route::get('/edit/{id}','v1\FeatureController@edit')->name('feature.edit');
			Route::post('/edit/{id}','v1\FeatureController@update');
			Route::get('/delete/{id}','v1\FeatureController@destroy')->name('feature.delete');
		});

		Route::group(['prefix'=>'g-journals'], function(){
			Route::get('','v1\GJournalController@index')->name('g-journals');
			Route::post('','v1\GJournalController@store')->name('g-journal.save');
			Route::get('/add','v1\GJournalController@create');
			Route::get('edit','v1\GJournalController@edit')->name('g-journal.edit');
			Route::post('edit','v1\GJournalController@update');
			Route::post('delete','v1\GJournalController@destroy')->name('g-journal.delete');
			Route::get('post', 'v1\GJournalController@post')->name('g-journal.post');
			Route::post('reset', 'v1\GJournalController@reset')->name('g-journal.reset');
			Route::post('update-new', 'v1\GJournalController@updateNew')->name('g-journal.update-new');
			Route::get('lists','v1\GJournalController@lists')->name('g-journal.lists');
			Route::get('edit-transaction','v1\GJournalController@editTransaction')->name('g-journal.edit-transaction');
			Route::get('delete-transaction/{id}','v1\GJournalController@destroyTransaction')->name('g-journal.delete-transaction');
		});

		Route::group(['prefix'=>'company-account-split-journals'], function(){
			Route::get('','v1\CompanyAccountSplitJournalController@index')->name('company-account-split-journals');
			Route::post('','v1\CompanyAccountSplitJournalController@store')->name('company-account-split-journal.save');
			Route::get('/add','v1\CompanyAccountSplitJournalController@create');
			Route::get('edit','v1\CompanyAccountSplitJournalController@edit')->name('company-account-split-journal.edit');
			Route::post('edit','v1\CompanyAccountSplitJournalController@update');
			Route::get('delete/{id}/{splitby?}','v1\CompanyAccountSplitJournalController@destroy')->name('company-account-split-journal.delete');
			Route::get('post', 'v1\CompanyAccountSplitJournalController@post')->name('company-account-split-journal.post');
			Route::post('reset', 'v1\CompanyAccountSplitJournalController@reset')->name('company-account-split-journal.reset');
			Route::get('split-account/{trans_no?}/{trans_line_no?}/{account_no?}/{split_by?}', 'v1\CompanyAccountSplitJournalController@accountSplitJournals')->name('company-account-split-journal.split-account');
			Route::get('sub-account/{id?}/{account_no?}', 'v1\CompanyAccountSplitJournalController@subAccount')->name('company-account-split-journal.sub-account');
		});

		Route::group(['prefix'=>'access-control-levels'], function(){
			Route::get('','v1\AccessControlLevelController@index')->name('acls');
			Route::post('','v1\AccessControlLevelController@store')->name('acl.save');
			Route::get('/add','v1\AccessControlLevelController@create');
			Route::get('/edit/{id}','v1\AccessControlLevelController@edit')->name('acl.edit');
			Route::post('/edit/{id}','v1\AccessControlLevelController@update');
			Route::get('/delete/{id}','v1\AccessControlLevelController@destroy')->name('acl.delete');

			Route::get('features/{id}','v1\AccessControlLevelController@features')->name('acl.features');
			Route::post('features/{id}','v1\AccessControlLevelController@storeFeature')->name('acl.feature.save');
			Route::get('features/{id}/delete/{permission_id}','v1\AccessControlLevelController@destroyFeature')->name('acl.feature.delete');

			Route::get('permissions/{id}','v1\AccessControlLevelController@permissions')->name('acl.permissions');
			Route::post('permissions/{id}','v1\AccessControlLevelController@storePermission')->name('acl.permission.save');
			Route::get('permissions/{id}/delete/{permission_id}','v1\AccessControlLevelController@destroyPermission')->name('acl.permission.delete');
		});

		Route::group(['prefix'=>'groups'], function(){
			Route::get('','v1\GroupController@index')->name('groups');
			Route::post('','v1\GroupController@store')->name('group.save');
			Route::get('/add','v1\GroupController@create')->name('group.add');
			Route::get('/edit/{id}','v1\GroupController@edit')->name('group.edit');
			Route::post('/edit/{id}','v1\GroupController@update');
			Route::get('/delete/{id}','v1\GroupController@destroy')->name('group.delete');
		});

		Route::group(['prefix'=>'roles'], function(){
			Route::get('','v1\RoleController@index')->name('roles');
			Route::post('','v1\RoleController@store')->name('role.save');
			Route::get('/add','v1\RoleController@create')->name('role.add');
			Route::get('/edit/{id}','v1\RoleController@edit')->name('role.edit');
			Route::post('/edit/{id}','v1\RoleController@update');
			Route::get('/delete/{id}','v1\RoleController@destroy')->name('role.delete');
			Route::get('permissions/{id}/{ajax?}','v1\RoleController@permissions')->name('role.permissions');
			Route::post('permissions/{id}','v1\RoleController@storePermission')->name('role.permission.save');
			Route::get('permissions/{id}/delete/{permission_id}','v1\RoleController@destroyPermission')->name('role.permission.delete');
		});

		Route::group(['prefix'=>'permissions'], function(){
			Route::get('','v1\PermissionController@index')->name('permissions');
			Route::post('','v1\PermissionController@store')->name('permission.save');
			Route::get('/add','v1\PermissionController@create')->name('permission.add');
			Route::get('/edit/{id}','v1\PermissionController@edit')->name('permission.edit');
			Route::post('/edit/{id}','v1\PermissionController@update');
			Route::get('/delete/{id}','v1\PermissionController@destroy')->name('permission.delete');
		});

		Route::get('clients','v1\UserController@clients')->name('client-users');
		Route::group(['prefix'=>'users'], function(){
			Route::get('','v1\UserController@users')->name('users');
			Route::get('activity/{id}','v1\UserController@statusActivity')->name('user.activity');
			Route::get('/edit-role/{id}/{any?}','v1\UserController@editRole')->name('user.edit-role');
			Route::post('/edit-role/{id}/{any?}','v1\UserController@updateRole');
			Route::get('/delete/{id}/{any?}','v1\UserController@destroy')->name('user.delete');
			Route::get('/user-activate/{id}/{any?}','v1\UserController@activate')->name('user.activate');
			Route::get('/user-deactivate/{id}/{any?}','v1\UserController@deactivate')->name('user.deactivate');
		});

		Route::group(['prefix'=>'designations'], function(){
			Route::get('','v1\DesignationController@index')->name('designations');
			Route::post('','v1\DesignationController@store')->name('designation.save');
			Route::get('/add','v1\DesignationController@create')->name('designation.add');
			Route::get('/edit/{id}','v1\DesignationController@edit')->name('designation.edit');
			Route::post('/edit/{id}','v1\DesignationController@update');
			Route::get('/delete/{id}','v1\DesignationController@destroy')->name('designation.delete');
		});

		Route::group(['prefix'=>'registration-types'], function(){
			Route::get('','v1\RegistrationTypeController@index')->name('registration-types');
			Route::post('','v1\RegistrationTypeController@store')->name('registration-type.save');
			Route::get('/add','v1\RegistrationTypeController@create')->name('registration-type.add');
			Route::get('/edit/{id}','v1\RegistrationTypeController@edit')->name('registration-type.edit');
			Route::post('/edit/{id}','v1\RegistrationTypeController@update');
			Route::get('/delete/{id}','v1\RegistrationTypeController@destroy')->name('registration-type.delete');
		});

		Route::group(['prefix'=>'signs'], function(){
			Route::get('','v1\SignController@index')->name('signs');
			Route::post('','v1\SignController@store')->name('sign.save');
			Route::get('/add','v1\SignController@create')->name('sign.add');
			Route::get('/edit/{id}','v1\SignController@edit')->name('sign.edit');
			Route::post('/edit/{id}','v1\SignController@update');
			Route::get('/delete/{id}','v1\SignController@destroy')->name('sign.delete');
		});

		Route::group(['prefix'=>'account-types'], function(){
			Route::get('','v1\AccountTypeController@index')->name('account-types');
			Route::post('','v1\AccountTypeController@store')->name('account-type.save');
			Route::get('/edit/{id}','v1\AccountTypeController@edit')->name('account-type.edit');
			Route::post('/edit/{id}','v1\AccountTypeController@update');
			Route::get('/delete/{id}','v1\AccountTypeController@destroy')->name('account-type.delete');
		});

		Route::group(['prefix'=>'account-split-items'], function(){
			Route::get('','v1\AccountSplitItemController@index')->name('account-split-items');
			Route::post('','v1\AccountSplitItemController@store')->name('account-split-item.save');
			Route::get('/edit/{id}','v1\AccountSplitItemController@edit')->name('account-split-item.edit');
			Route::post('/edit/{id}','v1\AccountSplitItemController@update');
			Route::get('/delete/{id}','v1\AccountSplitItemController@destroy')->name('account-split-item.delete');
		});

		Route::group(['prefix'=>'account-maps'], function(){
			Route::get('','v1\AccountMapController@index')->name('account-maps');
			Route::post('','v1\AccountMapController@store')->name('account-map.save');
			Route::get('/edit/{id}','v1\AccountMapController@edit')->name('account-map.edit');
			Route::post('/edit/{id}','v1\AccountMapController@update');
			Route::get('/delete/{id}','v1\AccountMapController@destroy')->name('account-map.delete');
			Route::post('update','v1\AccountMapController@updateType')->name('account-map.update');
			Route::post('ajax-index','v1\AccountMapController@ajaxIndex')->name('account-map.ajax-index');
		});

		Route::group(['prefix'=>'global-chart-of-accounts'], function(){
			Route::get('','v1\GlobalChartOfAccountController@index')->name('global-chart-of-accounts');
			Route::post('','v1\GlobalChartOfAccountController@store')->name('global-chart-of-account.save');
			Route::get('/edit/{id}','v1\GlobalChartOfAccountController@edit')->name('global-chart-of-account.edit');
			Route::post('/edit/{id}','v1\GlobalChartOfAccountController@update');
			Route::get('/delete/{id}','v1\GlobalChartOfAccountController@destroy')->name('global-chart-of-account.delete');
			Route::post('update','v1\GlobalChartOfAccountController@updateType')->name('global-chart-of-account.update');
			Route::post('ajax-index','v1\GlobalChartOfAccountController@ajaxIndex')->name('global-chart-of-account.ajax-index');
		});

		Route::group(['prefix'=>'naics-codes'], function(){
			Route::get('','v1\NaicsCodeController@index')->name('naics-codes');
			Route::post('','v1\NaicsCodeController@store')->name('naics-code.save');
			Route::get('/edit/{id}','v1\NaicsCodeController@edit')->name('naics-code.edit');
			Route::post('/edit/{id}','v1\NaicsCodeController@update');
			Route::get('/delete/{id}','v1\NaicsCodeController@destroy')->name('naics-code.delete');
		});

		Route::group(['prefix'=>'trades'], function(){
			Route::get('','v1\TradeController@index')->name('trades');
			Route::post('','v1\TradeController@store')->name('trade.save');
			Route::get('/edit/{id}','v1\TradeController@edit')->name('trade.edit');
			Route::post('/edit/{id}','v1\TradeController@update');
			Route::get('/delete/{id}','v1\TradeController@destroy')->name('trade.delete');
		});

		Route::group(['prefix'=>'global-currency-codes'], function(){
			Route::get('','v1\GlobalCurrencyCodeController@index')->name('global-currency-codes');
			Route::post('','v1\GlobalCurrencyCodeController@store')->name('global-currency-code.save');
			Route::get('/edit/{id}','v1\GlobalCurrencyCodeController@edit')->name('global-currency-code.edit');
			Route::post('/edit/{id}','v1\GlobalCurrencyCodeController@update');
			Route::get('/delete/{id}','v1\GlobalCurrencyCodeController@destroy')->name('global-currency-code.delete');
			Route::get('show/{id?}','v1\GlobalCurrencyCodeController@show')->name('global-currency-code.show');
		});

		Route::group(['prefix'=>'journals'], function(){
			Route::get('','v1\JournalController@index')->name('journals');
			Route::post('','v1\JournalController@store')->name('journal.save');
			Route::get('/edit/{id}','v1\JournalController@edit')->name('journal.edit');
			Route::post('/edit/{id}','v1\JournalController@update');
			Route::get('/delete/{id}','v1\JournalController@destroy')->name('journal.delete');
		});

		Route::group(['prefix'=>'account-classes'], function(){
			Route::get('','v1\AccountClassController@index')->name('account-classes');
			Route::post('','v1\AccountClassController@store')->name('account-class.save');
			Route::get('/edit/{id}','v1\AccountClassController@edit')->name('account-class.edit');
			Route::post('/edit/{id}','v1\AccountClassController@update');
			Route::get('/delete/{id}','v1\AccountClassController@destroy')->name('account-class.delete');
		});

		Route::group(['prefix'=>'company-locations'], function(){
			Route::get('','v1\CompanyLocationController@index')->name('company-locations');
			Route::post('','v1\CompanyLocationController@store')->name('company-location.save');
			Route::get('/edit/{id}','v1\CompanyLocationController@edit')->name('company-location.edit');
			Route::post('/edit/{id}','v1\CompanyLocationController@update');
			Route::get('/delete/{id}','v1\CompanyLocationController@destroy')->name('company-location.delete');
			Route::get('address/{id}','v1\CompanyLocationController@companyLocationAddress')->name('company-location.address');
			Route::post('address/{id}','v1\CompanyLocationController@updateCompanyLocationAddress');
		});

		Route::group(['prefix'=>'company-segments'], function(){
			Route::get('','v1\CompanySegmentController@index')->name('company-segments');
			Route::post('','v1\CompanySegmentController@store')->name('company-segment.save');
			Route::get('/edit/{id}','v1\CompanySegmentController@edit')->name('company-segment.edit');
			Route::post('/edit/{id}','v1\CompanySegmentController@update');
			Route::get('/delete/{id}','v1\CompanySegmentController@destroy')->name('company-segment.delete');
		});

		Route::group(['prefix'=>'job-projects'], function(){
			Route::get('','v1\JobProjectController@index')->name('job-projects');
			Route::post('','v1\JobProjectController@store')->name('job-project.save');
			Route::get('/edit/{id}','v1\JobProjectController@edit')->name('job-project.edit');
			Route::post('/edit/{id}','v1\JobProjectController@update');
			Route::get('/delete/{id}','v1\JobProjectController@destroy')->name('job-project.delete');
			Route::get('activity/{id}','v1\JobProjectController@statusActivity')->name('job-project.activity');
		});

		Route::group(['prefix'=>'company-documents'], function(){
			Route::get('','v1\CompanyDocumentController@index')->name('company-documents');
			Route::get('upload','v1\CompanyDocumentController@create')->name('company-document.add');
			Route::post('images-save','v1\CompanyDocumentController@store')->name('company-document.save');
			Route::post('images-delete', 'v1\CompanyDocumentController@destroyImg');
			Route::get('/edit/{id}','v1\CompanyDocumentController@edit')->name('company-document.edit');
			Route::post('/edit/{id}','v1\CompanyDocumentController@update');
			Route::get('/delete/{id}','v1\CompanyDocumentController@destroy')->name('company-document.delete');
		});

		Route::group(['prefix'=>'chart-of-account-groups'], function(){
			Route::get('','v1\ChartOfAccountGroupController@index')->name('chart-of-account-groups');
			Route::post('','v1\ChartOfAccountGroupController@store')->name('chart-of-account-group.save');
			Route::get('/edit/{id}','v1\ChartOfAccountGroupController@edit')->name('chart-of-account-group.edit');
			Route::post('/edit/{id}','v1\ChartOfAccountGroupController@update');
			Route::get('/delete/{id}','v1\ChartOfAccountGroupController@destroy')->name('chart-of-account-group.delete');

			Route::get('list/{coag_id}','v1\ChartOfAccountGroupListController@index')->name('chart-of-account-group-lists');
			Route::get('list/{coag_id}/add','v1\ChartOfAccountGroupListController@create')->name('chart-of-account-group-list.add');
			Route::post('list/{coag_id}','v1\ChartOfAccountGroupListController@store')->name('chart-of-account-group-list.save');
			Route::get('list/{coag_id}/edit/{id}','v1\ChartOfAccountGroupListController@edit')->name('chart-of-account-group-list.edit');
			Route::post('list/{coag_id}/edit/{id}','v1\ChartOfAccountGroupListController@update');
			Route::get('list/{coag_id}/delete/{id}','v1\ChartOfAccountGroupListController@destroy')->name('chart-of-account-group-list.delete');
			Route::post('list/{coag_id}/group-source','v1\ChartOfAccountGroupListController@groupSource')->name('chart-of-account-group-list.group-source');
		});

		Route::group(['prefix'=>'company-chart-of-accounts'], function(){
			Route::get('','v1\CompanyChartOfAccountController@index')->name('company-chart-of-accounts');
			Route::get('import','v1\CompanyChartOfAccountController@create')->name('company-chart-of-account.add');
			Route::post('import','v1\CompanyChartOfAccountController@import')->name('company-chart-of-account.import');
			Route::post('','v1\CompanyChartOfAccountController@store')->name('company-chart-of-account.save');
			Route::get('edit/{id}','v1\CompanyChartOfAccountController@edit')->name('company-chart-of-account.edit');
			Route::post('edit/{id}','v1\CompanyChartOfAccountController@update');
			Route::get('delete/{id}','v1\CompanyChartOfAccountController@destroy')->name('company-chart-of-account.delete');
			Route::post('group-source','v1\CompanyChartOfAccountController@groupSource')->name('company-chart-of-account.group-source');
		});

		Route::group(['prefix'=>'company-account-maps'], function(){
			Route::get('','v1\CompanyAccountMapController@index')->name('company-account-maps');
			Route::get('import','v1\CompanyAccountMapController@create')->name('company-account-map.add');
			Route::post('import','v1\CompanyAccountMapController@import')->name('company-account-map.import');
			Route::post('','v1\CompanyAccountMapController@store')->name('company-account-map.save');
			Route::get('edit/{id}','v1\CompanyAccountMapController@edit')->name('company-account-map.edit');
			Route::post('edit/{id}','v1\CompanyAccountMapController@update');
			Route::get('delete/{id}','v1\CompanyAccountMapController@destroy')->name('company-account-map.delete');
			Route::post('group-source','v1\CompanyAccountMapController@groupSource')->name('company-account-map.group-source');
		});

		Route::group(['prefix'=>'company-journals'], function(){
			Route::get('','v1\CompanyJournalController@index')->name('company-journals');
			Route::get('import','v1\CompanyJournalController@create')->name('company-journal.add');
			Route::post('import','v1\CompanyJournalController@import')->name('company-journal.import');
			Route::post('','v1\CompanyJournalController@store')->name('company-journal.save');
			Route::get('edit/{id}','v1\CompanyJournalController@edit')->name('company-journal.edit');
			Route::post('edit/{id}','v1\CompanyJournalController@update');
			Route::get('delete/{id}','v1\CompanyJournalController@destroy')->name('company-journal.delete');
			Route::post('group-source','v1\CompanyJournalController@source')->name('company-journal.group-source');
		});

		Route::group(['prefix'=>'company-terms'], function(){
			Route::get('','v1\CompanyTermController@index')->name('company-terms');
			Route::get('import','v1\CompanyTermController@create')->name('company-term.add');
			Route::post('import','v1\CompanyTermController@import')->name('company-term.import');
			Route::post('','v1\CompanyTermController@store')->name('company-term.save');
			Route::get('edit/{id}','v1\CompanyTermController@edit')->name('company-term.edit');
			Route::post('edit/{id}','v1\CompanyTermController@update');
			Route::get('delete/{id}','v1\CompanyTermController@destroy')->name('company-term.delete');
			Route::post('group-source','v1\CompanyTermController@source')->name('company-term.group-source');
		});

		Route::group(['prefix'=>'company-vendors'], function(){
			Route::get('','v1\CompanyVendorController@index')->name('company-vendors');
			Route::get('add','v1\CompanyVendorController@create')->name('company-vendor.add');
			Route::post('','v1\CompanyVendorController@store')->name('company-vendor.save');
			Route::get('edit/{id}','v1\CompanyVendorController@edit')->name('company-vendor.edit');
			Route::post('edit/{id}','v1\CompanyVendorController@update');
			Route::get('delete/{id}','v1\CompanyVendorController@destroy')->name('company-vendor.delete');
			Route::get('address/{id?}','v1\CompanyVendorController@address')->name('company-vendor.address');
			Route::post('address/{id}','v1\CompanyVendorController@updateAddress');
		});

		Route::group(['prefix'=>'map-groups'], function(){
			Route::get('','v1\MapGroupController@index')->name('map-groups');
			Route::post('','v1\MapGroupController@store')->name('map-group.save');
			Route::get('/edit/{id}','v1\MapGroupController@edit')->name('map-group.edit');
			Route::post('/edit/{id}','v1\MapGroupController@update');
			Route::get('/delete/{id}','v1\MapGroupController@destroy')->name('map-group.delete');

			Route::get('list/{map_group_id}','v1\MapGroupListController@index')->name('map-group-lists');
			Route::get('list/{map_group_id}/add','v1\MapGroupListController@create')->name('map-group-list.add');
			Route::post('list/{map_group_id}','v1\MapGroupListController@store')->name('map-group-list.save');
			Route::get('list/{map_group_id}/edit/{id}','v1\MapGroupListController@edit')->name('map-group-list.edit');
			Route::post('list/{map_group_id}/edit/{id}','v1\MapGroupListController@update');
			Route::get('list/{map_group_id}/delete/{id}','v1\MapGroupListController@destroy')->name('map-group-list.delete');
			Route::post('list/{map_group_id}/group-source','v1\MapGroupListController@groupSource')->name('map-group-list.group-source');
		});

		Route::group(['prefix'=>'terms'], function(){
			Route::get('','v1\TermController@index')->name('terms');
			Route::post('','v1\TermController@store')->name('term.save');
			Route::get('/edit/{id}','v1\TermController@edit')->name('term.edit');
			Route::post('/edit/{id}','v1\TermController@update');
			Route::get('/delete/{id}','v1\TermController@destroy')->name('term.delete');
		});

		Route::group(['prefix'=>'ledgers'], function(){
			Route::get('','v1\LedgerController@index')->name('ledgers');
			Route::post('','v1\LedgerController@store')->name('ledger.save');
			Route::get('/edit/{id}','v1\LedgerController@edit')->name('ledger.edit');
			Route::post('/edit/{id}','v1\LedgerController@update');
			Route::get('/delete/{id}','v1\LedgerController@destroy')->name('ledger.delete');
		});

		Route::group(['prefix'=>'company-fiscal-periods'], function(){
			Route::get('','v1\CompanyFiscalPeriodController@create')->name('company-fiscal-periods');
			Route::post('','v1\CompanyFiscalPeriodController@store')->name('company-fiscal-period.save');
			Route::get('select',function(){
				return redirect('company-fiscal-periods');
			});
			Route::post('/select','v1\CompanyFiscalPeriodController@select')->name('company-fiscal-period.select');
			Route::get('/edit/{id}','v1\CompanyFiscalPeriodController@edit')->name('company-fiscal-period.edit');
			Route::post('/edit/{id}','v1\CompanyFiscalPeriodController@update');
			Route::get('/delete/{id}','v1\CompanyFiscalPeriodController@destroy')->name('company-fiscal-period.delete');
		});

		Route::group(['prefix'=>'company-default-accounts'], function(){
			Route::get('','v1\CompanyDefaultAccountController@index')->name('company-default-accounts');
			Route::post('','v1\CompanyDefaultAccountController@store')->name('company-default-account.save');
		});

		Route::group(['prefix'=>'company-fiscal-periods-controls'], function(){
			Route::get('','v1\CompanyFiscalPeriodsControlController@index')->name('company-fiscal-periods-controls');
			Route::post('','v1\CompanyFiscalPeriodsControlController@store')->name('company-fiscal-periods-control.save');
			Route::get('list/{id?}','v1\CompanyFiscalPeriodsControlController@list')->name('company-fiscal-periods-control.list');
		});

		Route::group(['prefix'=>'tax-rates'], function(){
			Route::get('','v1\TaxRateController@index')->name('tax-rates');
			Route::post('','v1\TaxRateController@store')->name('tax-rate.save');
			Route::get('add-grouped','v1\TaxRateController@create')->name('tax-rate.add-grouped');
			Route::get('edit-grouped/{id}','v1\TaxRateController@editGrouped')->name('tax-rate.edit-grouped');
			Route::get('/edit/{id}','v1\TaxRateController@edit')->name('tax-rate.edit');
			Route::post('/edit/{id}','v1\TaxRateController@update');
			Route::get('/delete/{id}','v1\TaxRateController@destroy')->name('tax-rate.delete');
			Route::post('group-source','v1\TaxRateController@source')->name('tax-rate.group-source');
		});

		Route::group(['prefix'=>'company-sales-taxes'], function(){
			Route::get('','v1\CompanySalesTaxController@index')->name('company-sales-taxes');
			Route::get('import','v1\CompanySalesTaxController@import')->name('company-sales-tax.add');
			Route::post('import','v1\CompanySalesTaxController@import_save')->name('company-sales-tax.import');
			Route::post('','v1\CompanySalesTaxController@store')->name('company-sales-tax.save');
			Route::get('add-grouped','v1\CompanySalesTaxController@create')->name('company-sales-tax.add-grouped');
			Route::get('edit-grouped/{id}','v1\CompanySalesTaxController@editGrouped')->name('company-sales-tax.edit-grouped');
			Route::get('/edit/{id}','v1\CompanySalesTaxController@edit')->name('company-sales-tax.edit');
			Route::post('/edit/{id}','v1\CompanySalesTaxController@update');
			Route::get('/delete/{id}','v1\CompanySalesTaxController@destroy')->name('company-sales-tax.delete');
			Route::post('group-source','v1\CompanySalesTaxController@source')->name('company-sales-tax.group-source');
		});

		Route::group(['prefix'=>'account-groups'], function(){
			Route::get('','v1\AccountGroupsController@index')->name('account-groups');
			Route::post('','v1\AccountGroupsController@store')->name('account-group.save');
			Route::get('/edit/{id}','v1\AccountGroupsController@edit')->name('account-group.edit');
			Route::post('/edit/{id}','v1\AccountGroupsController@update');
			Route::get('/delete/{id}','v1\AccountGroupsController@destroy')->name('account-group.delete');
		});

		Route::group(['prefix'=>'national-chart-of-accounts'], function(){
			Route::get('','v1\NationalChartOfAccountController@index')->name('national-chart-of-accounts');
			Route::post('','v1\NationalChartOfAccountController@store')->name('national-chart-of-account.save');
			Route::get('/edit/{id}','v1\NationalChartOfAccountController@edit')->name('national-chart-of-account.edit');
			Route::post('/edit/{id}','v1\NationalChartOfAccountController@update');
			Route::get('/delete/{id}','v1\NationalChartOfAccountController@destroy')->name('national-chart-of-account.delete');

			Route::get('lists/{id}','v1\NationalChartOfAccountController@lists')->name('national-chart-of-account-lists');
			Route::post('lists/{id}','v1\NationalChartOfAccountController@storeList');
			Route::get('edit-list/{id}','v1\NationalChartOfAccountController@editList')->name('national-chart-of-account-list.edit');
			Route::post('edit-list/{id}','v1\NationalChartOfAccountController@updateList');
			Route::get('delete-list/{id}','v1\NationalChartOfAccountController@destroyList')->name('national-chart-of-account-list.delete');
		});

		Route::group(['prefix'=>'menus'], function(){
			Route::get('','v1\MenuController@index032618')->name('menus');
			Route::post('','v1\MenuController@storeMenuSet')->name('menu.save');

			Route::get('new-index','v1\MenuController@index032618');
			Route::get('menu-elements/{id}','v1\MenuController@menuElementsIndex032618')->name('menu-elements');
			Route::post('menu-elements/{id}','v1\MenuController@store032618')->name('menu.save-element');

			//Route::get('/add','v1\MenuController@create')->name('menu.add');
			Route::get('/edit/{id}','v1\MenuController@edit032618')->name('menu.edit');

			Route::get('/edit-element/{parent_id}/{id}','v1\MenuController@editMenuElement')->name('menu.edit-element');
			Route::post('/edit-element/{id}/{parent_id}','v1\MenuController@update');
			
			Route::post('/edit/{id}','v1\MenuController@update032618');
			Route::get('/delete/{id}','v1\MenuController@destroy032618')->name('menu.delete');
			
			Route::get('/delete-element/{id}/{parent_id}','v1\MenuController@destroyMenuElement')->name('menu.delete-element');
			
			Route::get('roles/{parent_id}/{id}','v1\MenuController@roles')->name('menu.roles');
			Route::post('roles/{parent_id}/{id}','v1\MenuController@storeRole')->name('menu.role.save');
			Route::get('roles/{parent_id}/{id}/delete/{role_id}','v1\MenuController@destroyRole')->name('menu.role.delete');
		});

	});
}

Route::group(['prefix'=>'user','middleware'=>'auth'], function(){
	Route::get('', function() {
		return redirect('user/profile');
	});
	Route::get('profile','v1\UserController@index')->name('user.profile');
	Route::get('profile/update','v1\UserController@index')->name('user.update');
	Route::post('profile/update','v1\UserController@update');
	Route::get('profile/password/reset','v1\UserController@showResetForm');
	Route::post('profile/password/reset','v1\UserController@reset')->name('user.password.request');
	Route::get('address','v1\UserController@address')->name('user.address');
	Route::post('address','v1\UserController@updateUserAdd');
});

if(request()->server('SERVER_NAME') == 'sysacc.netver.niel' || request()->server('SERVER_NAME') == 'sysacc.netver.com') {
//if(request()->server('SERVER_NAME') == 'dev.netver.com' || request()->server('SERVER_NAME') == 'www.netver.com') {
	Route::get('password/reset/{token}/{email}', function($token,$email){
		return redirect()->route('accountant.password.reset',[$token,$email]);
	});
	Route::group(['prefix'=>'advisors'], function(){
		Route::get('login', 'Auth\LoginController@showLoginFormAccountant')->name('accountant.login');
		Route::post('login', 'Auth\LoginController@login');
		Route::post('logout', 'Auth\LoginController@logout')->name('accountant.logout');
		Route::post('register', 'Auth\RegisterController@registerAccountant')->name('accountant.register');
		Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('accountant.password.email');
		Route::post('password/reset', 'Auth\ResetPasswordController@reset');

		Route::get('password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetFormAccountant')->name('accountant.password.reset');
		Route::get('register/confirm/{token}/{email}', 'Auth\RegisterController@showConfirmFormAccountant')->name('accountant.register.confirm');
		Route::post('register/confirm', 'Auth\RegisterController@confirmAccountant')->name('accountant.register.confirmed');

	    Route::get('register', 'Auth\RegisterController@showRegistrationFormAccountant');
	    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestFormAccountant')->name('accountant.password.request');
	    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetFormAccountant')->name('accountant.password.reset');


		Route::get('','Auth\RegisterController@showRegistrationFormAccountant')->name('register-accountant');
		Route::post('','Auth\RegisterController@registerAccountant');

		Route::group(['middleware'=>'auth'], function(){
			Route::get('profile','v1\CompanyController@accountantProfile')->name('accountant.profile');
			Route::post('profile','v1\CompanyController@accountantUpdateProfile');
		});
	});
}
Route::get('xxyyzz', function(){
	$audit_trails = \Illuminate\Support\Facades\DB::table('audit_trail')
		->join('users','audit_trail.user_id','=','users.id')
		->selectRaw('audit_trail.*,users.first_name')
		->orderBy('audit_trail.id','desc')
		->limit(20)
		->get();
	$ui_reports = \Illuminate\Support\Facades\DB::table('ui_reports')
		->join('users','ui_reports.user_id','=','users.id')
		->selectRaw('ui_reports.*,users.first_name')
		->orderBy('ui_reports.id','desc')
		->limit(20)
		->get();
	return view('layouts.plane')
		->with('audit_trails',$audit_trails)
		->with('ui_reports',$ui_reports);
});