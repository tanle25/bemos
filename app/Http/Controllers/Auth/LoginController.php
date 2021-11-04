<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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
    public function show()
    {
        # code...
        return view('user.auth.login');
    }

    public function login(Request $request)
    {

        $this->username = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::viaRemember()) {
            return redirect()->route('home');
        }
        if(Auth::guard('web')->attempt(['email' =>$request->email, 'password' => $request->password],true)){
            return redirect('/');
        }else{
            return back()->withErrors(['loginfail'=>'Invalid username or password']);
        }
        //dd(DB::getQueryLog());
    }
    public function username()
    {
        return $this->username;
    }
    public function logout(Request $request)
    {
        # code...
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush();
        return redirect('/');
    }
    public function adminlogout(Request $request)
    {
        # code...
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush();
        return redirect('/');
    }

}
