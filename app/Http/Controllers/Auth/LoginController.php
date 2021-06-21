<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('web')
            ->attempt($req->only('email','password')))
        {
            return redirect()->route('dashboard.index');

        }elseif (Auth::guard('owner')
            ->attempt($req->only('email','password'))){

            return redirect()->route('dashboard.index');


        }elseif (Auth::guard('customer')->attempt($req->only('email','password'))){

            return redirect()->route('main');
        }

        return redirect()->back()
            ->withErrors('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
