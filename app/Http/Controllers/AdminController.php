<?php

namespace App\Http\Controllers;
use Hash;
use App\Parents;
use App\Student;
use App\Class_Student;
use App\Admin;
use App\Profile;
use App\Evaluation_Question;
use App\AddClass;
use App\Class_Subject_Teacher;
use App\Teacher;
use Auth;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
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
             'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:admins|unique:students|unique:teachers|unique:parents',
            'email' => 'required|string|email|max:255|unique:admins|unique:students|unique:teachers|unique:parents',
            'password' => 'required|string|min:6|',
           

        ], [
            'name.regex'=>'Name contains invalid character!',
        ]);
 
    
        $admin = new Admin();
        $admin->role = "admin";
        $admin->name = $request->name;
        $admin->email=$request->email;
        $admin->password = Hash::make($request->password);
        $admin->status = "active";
        $admin->save();
        $request->session()->flash('alert-success', 'Account Successfully Created!');
        return redirect()->back();

    }
    public function admin()
    { 
        $admins = Admin::where('status','=','active')->orderBy('name')->paginate(10);
        return view('admin.admin',['admins'=>$admins]);
      
    }
    public function destroy_admin($id, Request $request)
    {
          $admin = Admin::find($id);
        $admin->status = "inactive";
        $admin->save();
        $request->session()->flash('alert-success', 'Account Successfully Removed!');
        return redirect()->back();
      
    }

    
    public function edit_admin(Request $request ,$id)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:students|unique:teachers|unique:parents',
           'email' => 'required|string|email|max:255|unique:students|unique:teachers|unique:parents',
           'password' => 'required|string|min:6|',
          

       ], [
           'name.regex'=>'Name contains invalid character!',
       ]);

        $admin = Admin::find($id);
        $admin->role = $request->role;
        $admin->name = $request->name;
        $admin->email=$request->email;
        $admin->password = Hash::make($request->password);

      if($admin->save()){
        $request->session()->flash('alert-success', 'Account Successfully Updated!');
        return redirect()->back();
      }

    }
    
    public function show_student()
    {
        $students = Student::where('status','=','active')->orWhere('status','=','no class')->orderBy('name')->paginate(10);
        return view('admin.students',['students'=>$students]);
      
    }

    public function student_excel(){
         $students = Student::where('status','=','active')->orWhere('status','=','no class')->orderBy('name')->get();
         $students_array[] = array('Name','Username','Email');
         foreach($students as $student){
             $students_array[] = array(
                 'Name' => $student->name,
                 'Username' => $student->username,
                 'Email' => $student->email,
             );
         }
  
  
         Excel::create('Students', function($excel) use ($students_array){
          $excel->setTitle('Students');
          $excel->sheet('Students', function($sheet) use ($students_array){
          $sheet->fromArray($students_array, null, 'A1', false, false);
          });
         })->download('xlsx');
    }
    
      public function student_import(Request $request){
        $input = request()->validate([
            'file_name' => 'required|mimes:xlsx,xls,csv|max:50000',

        ], [

       
            'file_name.mimes' => 'Invalid Format',
           'file_name.max' => 'File is too big',
            
            

        ]);

   
            if ($request->hasFile('file_name')) {
               $path = $request->file('file_name')->getRealPath();
                $data = Excel::load($path ,function($reader){})->get();
            
                    if(!empty($data) && $data->count()) {
                        foreach ($data as $key => $value){
                            $classes =DB::table('classes')->where([
                                ['year', '=', $value->year],
                                ['section', '=', $value->section],   ])->first()->id;
                                if(count($classes)>0){
                            $student = new Student();
                            $student->role = 'student';
                            $student->name = $value->name;
                            $student->username = $value->username;
                            $student->email = $value->email;
                            $student->password = Hash::make($value->username);
                            $student->status = 'active';
                            if ($student->save()){

                                $students = Student::where('name','=',$value->name)->get();
                    
                                $profile = new Profile();
                                $profile->student_id = $students->get(0)->id;
                                $profile->profile_pic = 'noimage.jpg';
                                $profile->bio = 'add a bio';
                                $profile->save();
                               
                                $class_subject=DB::table('class_subject_teacher')->where([
                                    [ 'class_id','=',$classes],
                                 ])->get();
                                 
                                 foreach($class_subject as $class_id){
                                 $class_student = new Class_Student();
                                 $class_student->class_subject_teacher_id = $class_id->id;
                                 $class_student->student_id = $students->get(0)->id;
                                 $class_student->save();
                                 }
                        
                        
                              
                        }
                    }
                 
                    }
                    $request->session()->flash('alert-success', 'Students were successful added!');
                    return redirect()->back();
                }
            }
    }
    public function destroy_student($id, Request $request)
    {
        $students = Student::find($id);
        $students->status = "inactive";
        $students->save();
        $request->session()->flash('alert-success', 'Account Successfully Removed!');
        return redirect()->back();
    }

    public function view_student($id){
        $students = Student::where('id','=',$id)->get();
        $class_students = Class_Student::with('class_subject_teachers','students')->where('student_id','=',$id)->get();
        return view('admin.view-students',['students'=>$students,'class_students'=>$class_students]);
    }

     public function edit_student($id)
    {
        $students = Student::where('id','=',$id)->get();
        $class_students = Class_Student::where('student_id','=',$id)->get();
        return view('admin.edit-student',['students'=>$students,'class_students'=>$class_students]);
    }
      public function update_student(Request $request, $id)
    {
        $input = request()->validate([
            'name' => 'required|string|regex:/^[a-zA-Z,. ]+$/u|max:255|unique:admins|unique:teachers|unique:parents',
            'username' => 'required|max:255|max:255|regex:/^[a-zA-Z,.0-9]+$/u|unique:teachers|unique:parents',
            'password' => 'required|string|min:6',
        ], [
      
            'name.regex'=>'Name contains invalid character!',
            'username.regex'=>'Username contains invalid character!',
        ]);
        $students = Student::find($id);
        $students->name = $request->name;
        $students->username = $request->username;
        $students->password = Hash::make($request->password);
        $students->role = 'student';
        $students->save();
        $request->session()->flash('alert-success', 'Student was successful updated!');
        return redirect()->route('admin.student.show');
    }

    public function show_parent()
    {
        $parents = Parents::where('status','=','active')->orderBy('name')->paginate(10);
        return view('admin.parent',['parents'=>$parents]);
      
    }
    
    public function parent_excel(){
        $parents = Parents::orderBy('name')->get();
        $parents_array[] = array('Name','Username','Email');
        foreach($parents as $parent){
            $parents_array[] = array(
                'Name' => $parent->name,
                'Username' => $parent->username,
                'Email' => $parent->email,
            );
        }
 
 
        Excel::create('Parents', function($excel) use ($parents_array){
         $excel->setTitle('Parents');
         $excel->sheet('Parents', function($sheet) use ($parents_array){
         $sheet->fromArray($parents_array, null, 'A1', false, false);
         });
        })->download('xlsx');
    }

    public function parent_import(Request $request){
        $input = request()->validate([
            'file_name' => 'required|mimes:xlsx,xls,csv|max:50000',

        ], [

       
            'file_name.mimes' => 'Invalid Format',
           'file_name.max' => 'File is too big',
            
            

        ]);

   
            if ($request->hasFile('file_name')) {
               $path = $request->file('file_name')->getRealPath();
                $data = Excel::load($path ,function($reader){})->get();
            
                    if(!empty($data) && $data->count()) {
                        foreach ($data as $key => $value){
                            $parent = new Parents();
                            $parent->role = 'parent';
                            $parent->name = $value->name;
                            $parent->username = $value->username;
                            $parent->email = $value->email;
                            $parent->password = Hash::make($value->username);
                            $parent->status = 'active';
                            $parent->save();

                   
                        
                 
                    }
                    $request->session()->flash('alert-success', 'Parents were successful added!');
                    return redirect()->back();
                }
            }
    }
    
    public function view_parent($id){
        $parents = Parents::where('id','=',$id)->get();
        $class_students = Class_Student::with('class_subject_teachers','students')->where('parent_id','=',$id)->get()->unique('student_id');
        return view('admin.view-parents',['parents'=>$parents,'class_students'=>$class_students]);
    }
    
    
    public function destroy_parent($id, Request $request)
    {
        $parents = Parents::find($id);
        $parents->status = 'inactive';
        $parents->save();
        $request->session()->flash('alert-success', 'Account Successfully Removed!');
        return redirect()->back();       
    }
    public function edit_parent($id)
    {
        $parents = Parents::where('id','=',$id)->get();
        return view('admin.edit-parent',['parents'=>$parents]);
    }
    public function update_parent(Request $request, $id)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:admins|unique:students|unique:teachers',
            'username' => 'required|max:255|max:255|regex:/^[a-zA-Z,.0-9]+$/u|unique:students|unique:teachers',
            'password' => 'required|string|min:6',
        ], [
            'name.regex'=>'Name contains invalid character!',
            'username.regex'=>'Username contains invalid character!',
            
        ]);
        $parents = Parents::find($id);
        $parents->name = $request->name;
        $parents->username = $request->username;
        $parents->password = Hash::make($request->password);
        $parents->role = 'parent';
        $parents->save();
        $request->session()->flash('alert-success', 'Parent was successful updated!');
     
        return redirect()->back();
        
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
        $admins = Admin::where('id',$i)->first();
        if (Hash::check($request->oldpassword, $admins->password)) {
        $admin = Admin::find($i);
        $admin->password = Hash::make($request['password']);
        $admin->save();
        $request->session()->flash('alert-success', 'Password successfully updated!');
        return redirect()->back();
              }
        else{
            $request->session()->flash('alert-danger', 'Wrong Password!');
        return redirect()->back();
        }
    }

    public function add_student_view(){
        return view('admin.add_student_view');
    }

    public function add_student_store(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:admins|unique:students|unique:teachers|unique:parents',
            'username' => 'required|string|max:255|regex:/^[a-zA-Z,.0-9]+$/u|unique:students|unique:teachers|unique:parents',
            'password' => 'required|string|min:6|',
            'year'=> 'required|string|exists:classes',
            'section'=> 'required|string|exists:classes',
        ], [

      
            
            

        ]);
        
        $year=Input::get('year');
        $section=Input::get('section');

        $classes =DB::table('classes')->where([
            ['year', '=', $year],
            ['section', '=', $section],


        ])->first()->id;
        
                    
        if(count($classes)>0){
        
        $student = new Student();
        $student->name = $request->name;
        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->role = 'student';
        $student->status = 'active';
     
        
        if ($student->save()){

            $students = Student::where('name','=',$request->name)->get();

            $profile = new Profile();
            $profile->student_id = $students->get(0)->id;
            $profile->profile_pic = 'noimage.jpg';
            $profile->bio = 'add a bio';
            $profile->save();
            
            $class_subject=DB::table('class_subject_teacher')->where([
                [ 'class_id','=',$classes],
             ])->get();
             
             foreach($class_subject as $class_id){
             $class_student = new Class_Student();
             $class_student->class_subject_teacher_id = $class_id->id;
             $class_student->student_id = $student->id;
             $class_student->save();
             }
            $request->session()->flash('alert-success', 'Student was successful added!');
        return redirect()->back();
        }
        }
        return redirect()->back()->with('message', 'Class not found!');
    }

    public function add_parent_view(){
        return view('admin.add_parent_view');
    }

    public function add_parent_store(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:admins|unique:students|unique:teachers|unique:parents',
            'username' => 'required|string|max:255|regex:/^[a-zA-Z,.0-9]+$/u|unique:students|unique:teachers|unique:parents',
            'password' => 'required|string|min:6|',

        ], [

      'name.regex'=>'Name contains invalid character!',
      'username.regex'=>'Username contains invalid character!',
            

        ]);
        
        $parent = new Parents();
        $parent->name = $request->name;
        $parent->username = $request->username;
        $parent->password = Hash::make($request->password);
        $parent->role = 'parent';
        $parent->status = 'active';
     
        
        if ($parent->save()){
            $request->session()->flash('alert-success', 'Parent was successful added!');
        return redirect()->back();
        }

        
    }

    public function enrollment_store(Request $request,$parent_id){
        $input = request()->validate([
            'year' => 'required|string|max:255|exists:classes',
            'section' => 'required|string|max:255|exists:classes',
            'name' => 'required|string|exists:students',

        ], [

      
            
            

        ]);
        $year = $request->year;
        $section = $request->section;
        $name = $request->name;

        
        $students = Student::where('name','=',$name)->first();

        $classes = AddClass::with('teachers')->where('year','=',$year)
        ->where('section','=',$section)
        ->first();

        if(count($classes)>0)
        {
                $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('class_id','=',$classes->id)->get();

                foreach($class_subject_teachers as $class){
                $class_students = Class_Student::with('class_subject_teachers','students')->where('class_subject_teacher_id','=',$class->id)
                ->where('student_id','=',$students->id)->get();
               
              
                foreach($class_students as $class_student){
                    $id = $class_student->id;
                $class_student = Class_Student::find($id);
                $class_student->student_id = $class_student->student_id;
                $class_student->class_subject_teacher_id = $class_student->class_subject_teacher_id;
                $class_student->parent_id = $parent_id;
                $class_student->save();
                }
            }
        }
        else{
            return redirect()->back()->withErrors('Class/Student not found.');
        }
        $request->session()->flash('alert-success', 'Student was successful added!');
        return redirect()->back();
      

    }
    public function enrollment_destroy($id, Request $request){
        $student = $request->student;
        $class_students = Class_Student::where('student_id',$student )->get();
        foreach($class_students as $class_student){
            $class_student->parent_id = null;
            $class_student->save();
        }
        $request->session()->flash('alert-success', 'Student was successful removed!');
        return redirect()->back();
      
    }


      public function class_list($id){
      
        $class_subject_teachers = Class_Subject_Teacher::where('class_id',$id)->first();
        $students = Student::where('status','=','no class')->get();
       $class_students = Class_student::with('class_subject_teachers','students')->where('class_subject_teacher_id',$class_subject_teachers->id)
       ->whereHas('students', function ($q) use($id){
        $q->where('status', 'active');
    })->get()
       ->sortBy(function($class_students){
           return $class_students->students->get(0)->name;
       });
        return view('admin.class_list',['class_students'=>$class_students,'class_subject_teachers'=>$class_subject_teachers,'students'=>$students]);
   
    }

    public function class_list_add(Request $request,$id)
    {
        $student_id = $request->student_id;
        $students = Student::where('id','=',$student_id)->first();
        $students->status = 'active';
        $students->save();   
        $class_subject=DB::table('class_subject_teacher')->where([
            [ 'class_id','=',$id],
         ])->get();
         
         foreach($class_subject as $class_id){
         $class_student = new Class_Student();
         $class_student->class_subject_teacher_id = $class_id->id;
         $class_student->student_id = $students->id;
         $class_student->save();
         }
        $request->session()->flash('alert-success', 'Student was successful added!');
    return redirect()->back();
    }

    public function class_list_delete($id, Request $request)
    {
       $class_students = Class_Student::where('student_id','=',$id)->delete();
       $students = Student::find($id);
       $students->status = 'no class';
       $students->save();
       $request->session()->flash('alert-success', 'Student successfuly removed');
       return redirect()->back();
    }

    public function class_list_excel($id){
        
        $class_subject_teachers = Class_Subject_Teacher::where('class_id',$id)->first();
 
        $class_students = Class_student::with('class_subject_teachers','students')->where('class_subject_teacher_id',$class_subject_teachers->id)->get()
       ->sortBy(function($class_students){
           return $class_students->students->get(0)->name;
       });

       $students[] = array('Student Name');
       foreach($class_students as $class_student){
           $students[] = array(
               'Student Name' => $class_student->students->get(0)->name,
           );
       }

       $classes[] = array('school year','year','section','section name','adviser','time','room');
       $classes[] = array(
            'school year' => $class_subject_teachers->classes->get(0)->school_year,
            'year' => $class_subject_teachers->classes->get(0)->year,
            'section' => $class_subject_teachers->classes->get(0)->section,
            'section name' => $class_subject_teachers->classes->get(0)->section_name,
            'adviser' => $class_subject_teachers->classes->get(0)->teachers->get(0)->name,
            'time' => $class_subject_teachers->classes->get(0)->time,
            'room' => $class_subject_teachers->classes->get(0)->room,
       );


       Excel::create('Class List', function($excel) use ($students,$classes){
        $excel->setTitle('Class List');
        $excel->sheet('Class List', function($sheet) use ($students,$classes){
        $sheet->fromArray($classes, null, 'A1', false, false);
        $sheet->fromArray($students, null, '', false, false);
        });
       })->download('xlsx');
       
    }
    
     public function search_student(Request $request)
   {
          $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
         
      $search = $request->search;
      $students = Student::where('name','=',$search)->where('status','=','active')->orWhere('status','=','no class')->orderBy('name')->paginate(10);
          if(count($students)==0){
        $request->session()->flash('alert-danger', 'Student not found!');
        return view('admin.students',['students'=>$students]);  
      }
         $request->session()->flash('alert-success', 'Student found!');
      return view('admin.students',['students'=>$students]);  
    }

    public function search_admin(Request $request)
    {
         $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
        
       $search = $request->search;
       $admins = Admin::where('status','=','active')->where('name','=',$search)->orderBy('name')->paginate(10);
         if(count($admins)==0){
        $request->session()->flash('alert-danger', 'Admin not found!');
       return view('admin.admin',['admins'=>$admins]);  
         }
           $request->session()->flash('alert-success', 'Admin found!');
          return view('admin.admin',['admins'=>$admins]); 
     }

     public function search_parent(Request $request)
    { 
         $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
     
       $search = $request->search;
       $parents = Parents::where('name','=',$search)->where('status','=','active')->orderBy('name')->paginate(10);
          if(count($parents)==0){
        $request->session()->flash('alert-danger', 'Parent not found!');
       return view('admin.parent',['parents'=>$parents]);
          }
          $request->session()->flash('alert-success', 'Parent found!');
          return view('admin.parent',['parents'=>$parents]);
     }

     public function search_teacher(Request $request)
     {
          $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
         
        $search = $request->search;
        $teachers = Teacher::where('name','=',$search)->where('status','=','active')->orderBy('name')->paginate(10);
          if(count($teachers)==0){
        $request->session()->flash('alert-danger', 'Teacher not found!');
        return view('view-teachers',['teachers'=>$teachers]);  
          }
          $request->session()->flash('alert-success', 'Teacher found!');
          return view('view-teachers',['teachers'=>$teachers]);  
      }
    
         public function archive_admin(){
        $admins = Admin::orderBy('name')->paginate(10);
        return view('admin.archive_admin',['admins'=>$admins]);
      }

       public function archive_search_admin(Request $request)
    {
         $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
        
       $search = $request->search;
       $admins = Admin::where('name','=',$search)->orderBy('name')->paginate(10);
         if(count($admins)==0){
        $request->session()->flash('alert-danger', 'Admin not found!');
       return view('admin.archive_admin',['admins'=>$admins]);  
         }
           $request->session()->flash('alert-success', 'Admin found!');
          return view('admin.archive_admin',['admins'=>$admins]); 
     }
    
      public function archive_teacher(){
        $teachers = Teacher::orderBy('name')->paginate(10);
        return view('admin.archive_teacher',['teachers'=>$teachers]);
      }

      public function archive_search_teacher(Request $request)
     {
          $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
         
        $search = $request->search;
        $teachers = Teacher::where('name','=',$search)->orderBy('name')->paginate(10);
          if(count($teachers)==0){
        $request->session()->flash('alert-danger', 'Teacher not found!');
        return view('admin.archive_teacher',['teachers'=>$teachers]);  
          }
          $request->session()->flash('alert-success', 'Teacher found!');
          return view('admin.archive_teacher',['teachers'=>$teachers]);  
      }
    
      public function archive_student(){
        $students = Student::orderBy('name')->paginate(10);
        return view('admin.archive_student',['students'=>$students]);
      }

    public function archive_search_student(Request $request)
   {
          $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
         
      $search = $request->search;
      $students = Student::where('name','=',$search)->orderBy('name')->paginate(10);
          if(count($students)==0){
        $request->session()->flash('alert-danger', 'Student not found!');
        return view('admin.archive_student',['students'=>$students]);  
      }
         $request->session()->flash('alert-success', 'Student found!');
      return view('admin.archive_student',['students'=>$students]);  
    }
    
      public function archive_parent(){
        $parents = Parents::orderBy('name')->paginate(10);
        return view('admin.archive_parent',['parents'=>$parents]);
      }
    
       public function archive_search_parent(Request $request)
    { 
         $input = request()->validate([
            'search' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u',
           
        ], [
            'search.regex'=>'Name contains invalid character!',
        ]);
     
       $search = $request->search;
       $parents = Parents::where('name','=',$search)->orderBy('name')->paginate(10);
          if(count($parents)==0){
        $request->session()->flash('alert-danger', 'Parent not found!');
       return view('admin.archive_parent',['parents'=>$parents]);
          }
          $request->session()->flash('alert-success', 'Parent found!');
          return view('admin.archive_parent',['parents'=>$parents]);
     }
}
