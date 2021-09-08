<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Request;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

//custome login
    public function username()
    {

        $value =request()->input('identfy');
        $key = filter_var($value, FILTER_VALIDATE_EMAIL)?'email':'username';
        request()->merge([$key=>$value]);
        return   $key ;
    }


    protected function authenticated()
    {

       $messege = 'Hi ' .request()-> user()->name. ' Logged Successfully , Nice Day';

       request()->request->add(['success'=>$messege]);
    }

}
