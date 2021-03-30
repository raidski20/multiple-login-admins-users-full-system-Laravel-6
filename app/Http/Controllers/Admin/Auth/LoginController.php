<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('Admin.auth.login');
    }

    public function login(Request $request)
    {
        // validate data
        $this->validate($request,
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt to login user
        if(Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']], $request->remember))
        {
            // if success, redirect to their intended location
            return redirect()->intended('admin');
        }
        else
        {
            return redirect()->back()->withErrors(['email'=>'These credentials do not match our records.'])->withInput($request->only('email', 'remember'));
        }
    }



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

}
