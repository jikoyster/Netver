<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginFormAccountant()
    {
        return view('auth.accountant.login');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->store_activity('login');
        if(Auth::user()->groups()->where('group_id',2)->count()) {
            if(!auth()->user()->companies->count())
                return redirect('home');
            if(!auth()->user()->companies->first()->company_email)
                return redirect('advisors/profile');
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->store_activity('logout');

        Auth::guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
