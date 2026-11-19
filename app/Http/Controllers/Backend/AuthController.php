<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;


class AuthController extends Controller
{
    public function login(){

        if (auth()->user()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }

    public function postLogin(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {

            if ((int) auth()->user()->status !== 1) {
                Auth::logout();
                return back()->withErrors(['username' => 'Your account is inactive.']);
            }

            if(isset($request->remember))
            {
                setcookie("user", $request->username, time()+(10 * 365 * 24 * 60 * 60), "/", "", false, true);
            }
            else
            {
                setcookie("user", "", time()-3600, "/", "", false, true);
            }

            return redirect()->intended('admin/dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
        
    }

}
