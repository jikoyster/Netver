<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    var $user_email;

    /**
     * Where to redirect users after resetting their password.
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

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function showResetFormAccountant(Request $request, $token = null)
    {
        return view('auth.accountant.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            /*'email' => 'required|email',*/
            'password' => 'required|regex:/^.*(?=.{1,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*]).*$/|confirmed|min:6',
        ];
    }

    protected function validationErrorMessages()
    {
        return ['password.regex'=>'Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 6 characters'];
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        $this->user_email = $user->email;

        event(new PasswordReset($user));

        //$this->guard()->login($user);
    }

    protected function sendResetResponse($response)
    {
        $response = 'Congratulation, you have successfully reset your password';
        return redirect()->route('accountant.login')->with('status', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($this->user_email)
                    ->withErrors(['email' => trans($response)]);
    }
}
