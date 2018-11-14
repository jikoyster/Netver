<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\UserStatusHistory;
use App\Address;
use App\Company;
use App\AccessControlLevel;
use App\AddressHistory;
use App\CountryCurrency;
use App\TimezoneData;
use App\MenuRole;
use App\Group;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class UserController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        $random_string = str_limit(strtoupper(md5(microtime())),6,'');
        /*dd(str_limit(strtoupper($random_string),6,''));*/
        $user = Auth::user();
        $user['new_system_user_id'] = $random_string;
        
        return view('v1.user.profile')->with('user',$user);
    }

    public function users()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        $users = Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') ? User::all() : User::where('parent_id',Auth::user()->id)->orWhere('id',Auth::user()->id)->get();
        return view('v1.user.index')
            ->with('users',$users);
    }

    public function clients()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        $users = Group::findOrFail(1);
        return view('v1.user.clients')
            ->with('users',$users);
    }

    public function showInvitationForm()
    {
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        if(!(Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin')))
            return redirect()->route('home');
        if(!auth()->user()->can('add'))
            return redirect()->route('users')->with('status', trans('You don\'t have permission to add/invite.'));
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        if(auth()->user()->hasRole('admin') && auth()->user()->owned_companies->count() < 1)
            return redirect()->route('companies')->with('status','You don\'t have company registered yet to invite a user.');
        $roles = Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') ? Role::where('enabled',1)->get() : Role::where('id','>',1)->get();
        return view('auth.register-invite')
            ->with('roles',$roles);
    }

    public function invite(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'role'  => 'required'
        ]);

        $random_string = str_limit(strtoupper(md5(microtime())),6,'');
        $user = User::create([
            'parent_id' => Auth::user()->id,
            'system_user_id' => $random_string,
            'designation_id' => 1,
            'first_name' => 'Default',
            'last_name' => '',
            'home_phone' => '',
            'mobile_phone' => '',
            'email' => $request->email,
            'password' => 'password'//bcrypt('password'),
        ]);
if($request->role != 1) {
        if(Auth::user()->groups()->count()) {
            $user->groups()->attach(Auth::user()->groups()->first()->id);
        } else {
            $user->groups()->attach(1); //Client = 1
        }
}
        $role = Role::find($request->role);
        $user->syncRoles($role->name);

        event(new Registered($user = $this->create($request->except(['role']))));

        /********************/
        /* send notification */
        /********************/
        $response1 = 'Invtitation email has been sent for a link to complete registration.';

        $response = $this->sendResetLink(
            $request->only('email'),
            $request->role
        );

        $response == 'emailconfirmation.sent'
                    ? $this->sendResetLinkResponse($response1)
                    : $this->sendResetLinkFailedResponse($request, $response);
        /********************/
        /* end notification */
        /********************/

        return redirect()->route('users')->with('status', trans($response));
    }

    public function sendResetLink(array $credentials, $type = null)
    {
        // First we will check to see if we found a user at the given credentials and
        // if we did not we will redirect back to this current URI with a piece of
        // "flash" data in the session to indicate to the developers the errors.
        $user = $this->broker()->getUser($credentials);

        if (is_null($user)) {
            return 'passwords.user';
        }

        // Once we have the reset token, we are ready to send the message out to this
        // user with a link to reset their password. We will then redirect back to
        // the current URI having nothing set in the session to indicate errors.
        $user->sendEmailConfirmationNotification(
            $this->broker()->getRepository()->create($user),
            $type
        );

        return 'emailconfirmation.sent';
    }

    /**
     * Show the form for user address
     *
     */
    public function address()
    {
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $address = User::findOrFail(Auth::id())->address->first();
        if(!$address)
            $address = [];
        //return $address;
        $countries = CountryCurrency::with('state_provinces')->get();
        $timezone_datas = TimezoneData::all();
        return view('v1.user.address')
            ->with('countries',$countries)
            ->with('address',$address)
            ->with('timezone_datas',$timezone_datas);
    }

    public function updateUserAdd(Request $request)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('user.address')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'country' => 'required',
            'state_province' => '',
            'line1' => '',
            'line2' => '',
            'city' => '',
            'zipcode' => '',
            'time_zone' => 'required'
        ]);

        $user = User::findOrFail(Auth::id());
        
        if($user->address->count()) {
            $address = Address::find($user->address->first()->id);

            $addHistory = new AddressHistory;
            $addHistory->address_id = $address->id;
            $addHistory->state_province_name = $address->state_province_name;
            $addHistory->line1 = $address->line1;
            $addHistory->line2 = $address->line2;
            $addHistory->city = $address->city;
            $addHistory->zip_code = $address->zip_code;
            $addHistory->time_zone = $address->time_zone;
            $addHistory->save();
        } else {
            $address = new Address;
        }
        
        $address->state_province_name = $request->state_province;
        $address->line1 = ($request->line1) ? $request->line1 : '';
        $address->line2 = ($request->line2) ? $request->line2 : '';
        $address->city = ($request->city) ? $request->city : '';
        $address->zip_code = ($request->zipcode) ? $request->zipcode : '';
        $address->time_zone = ($request->time_zone) ? $request->time_zone : '';

        $address->save();
        Auth::user()->address()->sync([$address->id=>['model_type'=>'App\User']]);

        $response = 'User Address Updated!';
        auth()->user()->store_activity('updated address - id#'.$address->id);

        return redirect()->route('user.address')->with('status', trans($response));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function editRole($id, $user_group = null)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('users')->with('status', trans('You don\'t have permission to edit.'));
        $user = User::findOrFail($id);
        if(auth()->user()->hasRole('super admin') && $user->hasRole('user'))
            return redirect()->route('users')->with('status', trans('User is under client to edit.'));
        $groups = Group::all();
        $roles = Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') ? Role::where('enabled',1)->get() : Role::where('id','>',1)->get();
        return view('v1.user.edit-role')
            ->with('roles',$roles)
            ->with('groups',$groups)
            ->with('user_group',$user_group)
            ->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('user.profile')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'email' => 'required|string|email|unique:users,email,'.$request->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'home_phone' => '',
            'mobile_phone' => ''
        ]);

        $user = User::find($request->id);
        $user->system_user_id = $request->system_user_id;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->home_phone = ($request->home_phone) ? $request->home_phone : '';
        $user->mobile_phone = ($request->mobile_phone) ? $request->mobile_phone : '';
        $user->save();

        auth()->user()->store_activity('updated user profile of '.$user->first_name.' '.$user->last_name);
        $response = 'User Details Updated!';
        return redirect()->route('user.profile')->with('status', trans($response));
    }

    public function updateRole(Request $request, $id, $user_group = null)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('users')->with('status', trans('You don\'t have permission to edit.'));
        $validator = $request->validate([
            'system_user_id' => 'required',
            'first_name' => 'required',
            'roles' => 'required',
            'group' => 'required'
        ],['roles.required'=>'Please select role.']);

        $adminUserCount = Role::where('name','system admin')->first()->users()->count();
        $user = User::find($id);
        $role = Role::whereIn('id',$request->roles);
        if($role->count()) {
            $user->roles()->detach();
            $names = $role->pluck('name');
            if($adminUserCount == 1 && $user->getRoleNames()->contains('system admin') && !in_array('system admin', $names->toArray())) {
                $response = 'Failed, There should be an System Admin User';
            } else {
                foreach($names as $name) {
                    if(!$user->hasRole($name))
                        $user->assignRole($name);
                }
            }
        } else {
            $response = '';
        }

        if($request->group) {
            $user->groups()->sync($request->group);
        } else {
            $user->groups()->detach();
        }

        $response = 'User Profile Updated!';
        auth()->user()->store_activity('updated user profile of '.$user->first_name.' '.$user->last_name);
        
        return redirect()->route($user_group ? 'client-users':'users')->with('status', trans($response));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user_group = null)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('users')->with('status', trans('You don\'t have permission to delete.'));
        if($id == 3 || $id == 4)
            return redirect()->route('users')->with('status','Cannot Delete!');
        $user = User::findOrFail($id);
        if(auth()->user()->hasRole('admin') && auth()->user()->id != $user->parent_id)
            return redirect()->route('users')->with('status','ERROR: Cannot Delete!');
        $message = [];
        if($user->invited_users->count()) {
            /*return redirect()->route('users')->with('status','Delete first '.$user->invited_users()->first()->first_name.' '.$user->invited_users()->first()->last_name);*/
            $this->destroy($user->invited_users()->first()->id);
        }
        if($user->address->count()) {
            $address_ids = $user->address->pluck('id');
            $user->address()->detach();
            AddressHistory::whereIn('address_id',$address_ids)->delete();
            Address::whereIn('id',$address_ids)->delete();
            $message[] = 'deleted address';
        }
        if($user->companies->count()) {
            $user->companies()->detach();
            $message[] = 'deleted companies';
        }
        if($user->owned_companies->count()) {
            $company_ids = $user->owned_companies->pluck('company_id');
            $user->owned_companies()->delete();
            Company::whereIn('id',$company_ids)->delete();
            $message[] = 'deleted owned companies';
        }
        if($user->groups->count()) {
            $user->groups()->detach();
            $message[] = 'deleted groups';
        }
        if($user->audit_trails->count()) {
            $user->audit_trails()->delete();
            $message[] = 'deleted audit trails';
        }
        if($user->ui_reports->count()) {
            $user->ui_reports()->delete();
            $message[] = 'deleted errors and bugs report';
        }
        if($user->ui_reports_solved->count()) {
            $user->ui_reports_solved()->delete();
            $message[] = 'deleted solved errors and bugs report';
        }
        if($user->access_control_level) {
            foreach($user->access_control_level->pluck('id') as $id) {
                AccessControlLevel::find($id)->features()->detach();
            }
            $user->access_control_level()->delete();
            $message[] = 'deleted access control level';
        }
        if($user->user_status_histories->count()) {
            $user->user_status_histories()->delete();
            $message[] = 'deleted user status history';
        }
        if($user->company_fiscal_periods->count()) {
            $user->company_fiscal_periods()->delete();
            $message[] = 'deleted company fiscal periods';
        }
        $user->syncRoles([]);
        auth()->user()->store_activity('deleted user - id#'.$user->id);
        $user->delete();
        return redirect()->route($user_group ? 'client-users':'users')->with('status',$message);
    }

    public function statusActivity($id)
    {
        $activities = User::findOrFail($id)->user_status_histories->sortByDesc('id');
        return view('v1.activated-status-histories.index')->with('activities',$activities);
    }

    public function activate($id, $group = null)
    {
        $user = User::findOrFail($id);
        $user_status = new UserStatusHistory;
        $user_status->activated = 1;
        $user->user_status_histories()->save($user_status);
        auth()->user()->store_activity('activated user '.$user->first_name.' '.$user->last_name);
        return redirect()->route($group ? 'client-users':'users')->with('status','User Activated!');
    }

    public function deactivate($id, $group = null)
    {
        $user = User::findOrFail($id);
        $user_status = new UserStatusHistory;
        $user_status->activated = 0;
        $user->user_status_histories()->save($user_status);
        auth()->user()->store_activity('deactivated user '.$user->first_name.' '.$user->last_name);
        return redirect()->route($group ? 'client-users':'users')->with('status','User Deactivated!');
    }

    public function showResetForm()
    {
        if($this->firstLogin())
            return redirect()->route('accountant-company.profile');
        if(!$this->authenticate_local())
            return redirect()->route('home')->with('error_message',Controller::error_message(1));
        $user = Auth::user();
        $token = $this->broker()->createToken($user);
        return view('auth.passwords.reset-user-profile')->with(
            ['token' => $token, 'email' => $user->email]
        );
    }
    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'password' => 'required|regex:/^.*(?=.{1,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*]).*$/|confirmed|min:6',

        ], [
            'password.regex' => 'Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 6 characters'
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        Auth::guard()->logout();

        $request->session()->invalidate();

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request, $response);
    }
    public function broker()
    {
        return Password::broker();
    }
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        $this->user_email = $user->email;

        event(new PasswordReset($user));
    }
    protected function sendResetResponse($response)
    {
        $response = 'Congratulation, you have successfully reset your password';
        return redirect('login')->with('status', trans($response));
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput(['email'=>$request->email])
                    ->withErrors(['email' => trans($response)]);
    }

    public function user_logout()
    {
        auth()->user()->store_activity('logout');
        auth()->guard()->logout();
        session()->invalidate();
        return redirect('/');
    }
}
