<?php

namespace App\Http\Controllers;
use App\Class_Student;
use App\Student;
use App\Teacher_Profile;
use App\Evaluation_Question;
use Auth;
use Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student');
    }
    

    public function account()
    {
        $i = Auth::user()->id;
        $student = Student::where('id','=',$i)->get();
        return view('student.account',['student'=>$student]);
    }

    public function edit_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:students',
        ], [
  

        ]);
  

        $i = Auth::user()->id;
        $student = Student::find($i);
        $student->email = $request->email;
        $student->save();
        $request->session()->flash('alert-success', 'Email successfully updated!');
        return redirect()->back();
    }

    public function edit_pass(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ], [
  

        ]);

        $i = Auth::user()->id;
        $students = Student::where('id',$i)->first();
        if (Hash::check($request->oldpassword, $students->password)) {
        $student = Student::find($i);
        $student->password = Hash::make($request['password']);
        $student->save();
        $request->session()->flash('alert-success', 'Password successfully updated!');
        return redirect()->back();
         }
        else{
            $request->session()->flash('alert-danger', 'Wrong Password!');
        return redirect()->back();
        }
    }

   

   
}
