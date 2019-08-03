<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.student-login');
    }
    
    public function login(Request $request)
    {
        //validate
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [


    
            
            

        ]);
        //attempt to login
        if (Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            
            return redirect('/student/class');
        }
           
        return redirect()->back()->withInput($request->only('username','remember'))->withErrors('Invalid username/password!');
    }
    
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/student/login');
    }
}
