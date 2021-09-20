<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['guest','auth'])->except('logout');
    }

    public function showLoginForm()
    {
        if( Auth::check() && ( Auth::user()->hasRole('super-admin') ||Auth::user()->hasRole('admin') )  ){
            return redirect()->route('admin.index');
        }
        return view('backend.auth.login');
    }

//custome login
    public function username()
    {
        $value =request()->input('identfy');
        $key = filter_var($value, FILTER_VALIDATE_EMAIL)?'email':'username';
        request()->merge([$key=>$value]);
        return   $key ;
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     // return redirect()->route('admin.dashboard');
    // }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin/login');
    }

    public function redirectPath()
    {

        return 'admin/index';
    }


    protected function authenticated(Request $request, $user)
    {

        if( !Auth::user()->hasRole('super-admin') ||!Auth::user()->hasRole('admin')){
            return redirect()->route('admin.login')->withErrors(['failed'=>'thats not admin account']);
        }
    }
}
