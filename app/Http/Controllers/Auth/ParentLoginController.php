<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class ParentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:parent',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.parent-login');
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
        if (Auth::guard('parent')->attempt(['username' => $request->username, 'password' => $request->password,'status'=>'active'], $request->remember)) {
            
            return redirect('parent/classes');
        }
           
        return redirect()->back()->withInput($request->only('username','remember'))->withErrors('Invalid username/password!');
    }
    
    public function logout()
    {
        Auth::guard('parent')->logout();
        return redirect('/parent/login');
    }
}
