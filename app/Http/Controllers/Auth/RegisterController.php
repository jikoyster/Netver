<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserStatusHistory;
use App\Company;
use App\CompanyOwner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use SendsPasswordResetEmails;

    var $user_email;
    var $first_name;
    var $last_name;
    var $activated_at;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $response = $data['g-recaptcha-response'];

        /* recaptcha validation */
        $result = $this->stream_opts($response);

        $validator = Validator::make($data, [
            /*'name' => 'required|string|max:255',*/
            'email' => 'required|string|email|max:255|unique:users',
            /*'password' => 'required|string|min:6|confirmed',*/
            'g-recaptcha-response' => 'required'
        ], ['g-recaptcha-response.required'=>'Please check reCAPTCHA']);

        return $validator->after(function($validator) use ($result){
            if($result->success === false)
                $validator->errors()->add('g-recaptcha-response', 'Something is wrong with reCAPTCHA!');
        });
    }

    protected function stream_opts($response)
    {
        if(request()->server('SERVER_NAME') == 'sysacc.netver.com') {
            $result = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeYdTMUAAAAAGB6giKQNmse-EE8DLy0nHNrtGsD&response=$response"));
        } else {
            $stream_opts = [
                "ssl" => [
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ]
            ];
            $result = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeYdTMUAAAAAGB6giKQNmse-EE8DLy0nHNrtGsD&response=$response",false,stream_context_create($stream_opts)));
        }
        return $result;
    }

    protected function validatorAccountant(array $data)
    {
        $response = $data['g-recaptcha-response'];

        /* recaptcha validation */
        $result = $this->stream_opts($response);

        $validator = Validator::make($data, [
            'company_name' => 'required|unique:companies,trade_name',
            'email' => 'required|string|email|max:255|unique:users',
            /*'password' => 'required|string|min:6|confirmed',*/
            'g-recaptcha-response' => 'required'
        ], [
            'g-recaptcha-response.required'=>'Please check reCAPTCHA',
            'company_name.unique'=>'The company name ":input" has already been taken.'
        ]);

        return $validator->after(function($validator) use ($result){
            if($result->success === false)
                $validator->errors()->add('g-recaptcha-response', 'Something is wrong with reCAPTCHA!');
        });
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $random_string = str_limit(strtoupper(md5(microtime())),6,'');
        $user = User::create([
            'system_user_id' => $random_string,
            'designation_id' => 1,
            'first_name' => 'Default',
            'last_name' => '',
            'home_phone' => '',
            'mobile_phone' => '',
            'email' => $data['email'],
            'password' => 'password'//bcrypt('password'),
        ]);

        $user->groups()->attach(1); //Client = 1
        $user->syncRoles('admin'); //client-admin

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showRegistrationFormAccountant()
    {
        return view('auth.accountant.register-accountant');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /********************/
        /* send notification */
        /********************/
        $response1 = 'Please check your email for a link to a page where you can complete your registration.';

        $response = $this->sendResetLink(
            $request->only('email')
        );

        return $response == 'emailconfirmation.sent'
                    ? $this->sendResetLinkResponse($response1)
                    : $this->sendResetLinkFailedResponse($request, $response);
        /********************/
        /* end notification */
        /********************/

        return redirect()->route('login')->with('status', trans($response));
    }

    public function registerAccountant(Request $request)
    {
        $this->validatorAccountant($request->all())->validate();

        $random_string = str_limit(strtoupper(md5(microtime())),6,'');
        $user = User::create([
            'system_user_id' => $random_string,
            'designation_id' => 1,
            'first_name' => 'Default',
            'last_name' => '',
            'home_phone' => '',
            'mobile_phone' => '',
            'email' => $request->email,
            'password' => 'password'//bcrypt('password'),
        ]);

        $user->groups()->attach(2); //Accountant = 2
        $user->syncRoles('admin'); //accountant-admin

        $random_string = str_limit(strtoupper(md5(microtime())),6,'');
        $company = new Company;
        $company->company_key = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0x0fff ) | 0x4000, mt_rand( 0, 0x3fff ) | 0x8000, mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
        $company->trade_name = $request->company_name;
        $company->account_no = $random_string;
        $company->save();

        $company_owner = new CompanyOwner;
        $company_owner->company_id = $company->id;
        $company_owner->date_ownership = now();
        $company_owner->ownership_percentage = 100;
        $company_owner->leave_ownership = '0001-01-01';

        $user->owned_companies()->save($company_owner);
        $user->companies()->attach($company->id); // new

        event(new Registered($user));

        /********************/
        /* send notification */
        /********************/
        $response1 = 'Please check your email for a link to a page where you can complete your registration.';

        $response = $this->sendResetLink(
            $request->only('email'),
            'accountant'
        );

        return $response == 'emailconfirmation.sent'
                    ? $this->sendResetLinkResponse($response1)
                    : $this->sendResetLinkFailedResponse($request, $response);
        /********************/
        /* end notification */
        /********************/

        return redirect()->route('accountant.login')->with('status', trans($response));
    }

    public function sendResetLink(array $credentials, $type = null)
    {
        // First we will check to see if we found a user at the given credentials and
        // if we did not we will redirect back to this current URI with a piece of
        // "flash" data in the session to indicate to the developers the errors.
        $user = $this->broker()->getUser($credentials);

        if (is_null($user)) {
            return static::INVALID_USER;
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

    public function showConfirmForm(Request $request, $token = null)
    {
        $user = User::where('email',$request->email);
        if($user->count()) {
            if($user->first()->password != 'password')
                return redirect()->route('login')->with('status','Sorry! The link is expired.');
        }
        return view('auth.register-2')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function showConfirmFormAccountant(Request $request, $token = null)
    {
        return view('auth.accountant.register-2')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /* confirm account */
    public function confirm(Request $request)
    {
        $this->validate($request, $this->rules(), ['password.regex'=>'Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 6 characters']);

        $this->first_name = $request->first_name;
        $this->last_name = $request->last_name;
        $this->activated_at = now();

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    public function confirmAccountant(Request $request)
    {
        $this->validate($request, $this->rules(), ['password.regex'=>'Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 6 characters']);

        $this->first_name = $request->first_name;
        $this->last_name = $request->last_name;
        $this->activated_at = now();

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponseAccountant($response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => '',
            'password' => 'required|regex:/^.*(?=.{1,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*]).*$/|confirmed|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    protected function sendResetResponse($response)
    {
        $response = 'Congratulation, you have successfully created your account';
        return redirect()->route('login')
                            ->with('status', trans($response));
    }

    protected function sendResetResponseAccountant($response)
    {
        $response = 'Congratulation, you have successfully created your account';
        return redirect()->route('accountant.login')
                            ->with('status', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($this->user_email)
                    ->withErrors(['email' => trans($response)]);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->activated_at = $this->activated_at;

        $user->setRememberToken(Str::random(60));

        $user->save();

        $user_status = new UserStatusHistory;
        $user_status->activated = 1;
        $user->user_status_histories()->save($user_status);

        $this->user_email = $user->email;

        event(new PasswordReset($user));

        //Auth::guard()->login($user);
    }

    /* end confirm account */
}
