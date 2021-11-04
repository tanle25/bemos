<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('auth.admin.login');
    }
    public function login(Request $request)
    {
        # code...
        // dd($request);
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->username, 'password'=>$request->password])){
            return redirect('/admin');
        }else{
            return back();
        }
    }
}
