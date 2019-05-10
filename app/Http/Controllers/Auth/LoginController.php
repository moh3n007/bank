<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    protected $maxAttempts = 5;

    protected $decayMinutes = 5; //in minutes

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ],[
            $this->username().'.required' => 'نام کاربری را وارد کنید',
            'password.required' => 'پسوورد را وارد کنید',
        ]);
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (\Auth::attempt([$this->username() => $request['username'], 'password' => $request['password']])) {
            $user = \Auth::user();
            $now = date('Y-m-d H:i:s');
            $user->last_login = $now;
            $user->save();
            return redirect()->intended($this->redirectTo);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
