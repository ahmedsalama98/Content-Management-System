<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
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

        return 'admin/dashboard';
    }

}
