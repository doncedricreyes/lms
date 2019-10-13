<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class TeacherLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:teacher',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.teacher-login');
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
        if (Auth::guard('teacher')->attempt(['username' => $request->username, 'password' => $request->password, 'status'=>'active'], $request->remember)) {
            
            return redirect('/teacher/class');
        }
           
        return redirect()->back()->withInput($request->only('username','remember'))->withErrors('Invalid username/password!');
    }
    
    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect('/teacher/login');
    }
}
