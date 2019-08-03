<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    
    public function login(Request $request)
    {
        //validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [

            
            

        ]);
        
        //attempt to login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            
            return redirect('/admin/class');
        }
           
        return redirect()->back()->withInput($request->only('email','remember'))->withErrors('Invalid email/password!');
    }
    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
