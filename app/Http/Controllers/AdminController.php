<?php

namespace App\Http\Controllers;
use Hash;
use App\Parents;
use App\Student;
use App\Class_Student;
use App\Admin;
use App\Profile;
use App\Evaluation_Question;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function create()
    {
        return view('admin.create-admin');
    }
    public function store(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:parents|unique:students|unique:teachers|unique:admins',
            'password' => 'required|string|min:6|',
           

        ], [

        ]);
 
    
        $admin = new Admin();
        $admin->role = "admin";
        $admin->name = $request->name;
        $admin->email=$request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $request->session()->flash('alert-success', 'Account Successfully Created!');
        return redirect()->back();

    }
    public function admin()
    {
        $admins = Admin::orderBy('name')->paginate(10);
        return view('admin.admin',['admins'=>$admins]);
      
    }
    public function destroy_admin($id, Request $request)
    {
        $admins = Admin::find($id);
        if($admins->delete()){
            $request->session()->flash('alert-success', 'Account successfully deleted!');
            return redirect()->back();
        }
      
    }

    public function show_student()
    {
        $students = Student::orderBy('name')->paginate(10);
        return view('admin.students',['students'=>$students]);
      
    }
    
    
    public function destroy_student($id, Request $request)
    {
        $students = Student::find($id);
       if( $students->delete()){
        $request->session()->flash('alert-success', 'Account successfully deleted!');
        return redirect()->route('admin.student.show');
       }
        
    }

    public function view_student($id){
        $students = Student::where('id','=',$id)->get();
        $class_students = Class_Student::with('class_subject_teachers','students')->where('student_id','=',$id)->get();
        return view('admin.view-students',['students'=>$students,'class_students'=>$class_students]);
    }


    public function show_parent()
    {
        $parents = Parents::orderBy('name')->paginate(10);
        return view('admin.parent',['parents'=>$parents]);
      
    }
    public function view_parent($id){
        $parents = Parents::where('id','=',$id)->get();
        $class_students = Class_Student::with('class_subject_teachers','students')->where('parent_id','=',$id)->get()->unique('name');
        return view('admin.view-parents',['parents'=>$parents,'class_students'=>$class_students]);
    }
    
    
    public function destroy_parent($id, Request $request)
    {
        $parents = Parents::find($id);
        if(  $parents->delete()){
            $request->session()->flash('alert-success', 'Account successfully deleted!');
            return redirect()->back();
        }
      
       
    }

    public function account()
    {
        $i = Auth::user()->id;
        $admin = Admin::where('id','=',$i)->get();
        return view('admin.account',['admin'=>$admin]);
    }

    public function edit_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:parents|unique:students|unique:teachers|unique:admins',
        ], [
  

        ]);
  

        $i = Auth::user()->id;
        $admin = Admin::find($i);
        $admin->email = $request->email;
        $admin->save();
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
        $admin = Admin::find($i);
        $admin->password = Hash::make($request['password']);
        $admin->save();
        $request->session()->flash('alert-success', 'Password successfully updated!');
        return redirect()->back();
    }

    public function add_student_view(){
        return view('admin.add_student_view');
    }

    public function add_student_store(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:students',
            'password' => 'required|string|min:6|',
        ], [

      
            
            

        ]);
        
        $student = new Student();
        $student->name = $request->name;
        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->role = 'student';
        
     
        
        if ($student->save()){

            $students = Student::where('name','=',$request->name)->get();

            $profile = new Profile();
            $profile->student_id = $students->get(0)->id;
            $profile->profile_pic = 'noimage.jpg';
            $profile->bio = 'add a bio';
            $profile->save();
            $request->session()->flash('alert-success', 'Student was successful added!');
        return redirect()->back();
        }
    
        
    }

    public function add_parent_view(){
        return view('admin.add_parent_view');
    }

    public function add_parent_store(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:parents',
            'password' => 'required|string|min:6|',

        ], [

      
            
            

        ]);
        
        $parent = new Parents();
        $parent->name = $request->name;
        $parent->username = $request->username;
        $parent->password = Hash::make($request->password);
        $parent->role = 'parent';
        
     
        
        if ($parent->save()){
            $request->session()->flash('alert-success', 'Parent was successful added!');
        return redirect()->back();
        }

        
    }

   


}
