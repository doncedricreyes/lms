<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddClass;
use App\AddSubject;
use App\Class_Subject_Teacher;
use App\Teacher_Profile;
use App\Teacher;
use Excel;
use Hash;
use Auth;
use Session;
    

class AddTeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $teachers = Teacher::orderBy('name')->paginate(10);
    return view('view-teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacher_excel(){
        $teachers = Teacher::orderBy('name')->get();
        $teachers_array[] = array('Name','Username','Email');
        foreach($teachers as $teacher){
            $teachers_array[] = array(
                'Name' => $teacher->name,
                'Username' => $teacher->username,
                'Email' => $teacher->email,
            );
        }
 
 
        Excel::create('Teacher', function($excel) use ($teachers_array){
         $excel->setTitle('Teachers');
         $excel->sheet('Teachers', function($sheet) use ($teachers_array){
         $sheet->fromArray($teachers_array, null, 'A1', false, false);
         });
        })->download('xlsx');
    }
    
    
        public function teacher_import(Request $request){
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
                            $teacher = new Teacher();
                            $teacher->role = 'teacher';
                            $teacher->name = $value->name;
                            $teacher->username = $value->username;
                            $teacher->email = $value->email;
                            $teacher->password = Hash::make($value->username);
                           
                            if ($teacher->save()){

                                $teachers = Teacher::where('name','=',$value->name)->get();
                    
                                $teacher_profile = new Teacher_Profile();
                                $teacher_profile->teacher_id = $teachers->get(0)['id'];
                                $teacher_profile->profile_pic = 'noimage.jpg';
                                $teacher_profile->bio = 'add a bio';
                                $teacher_profile->save();
                               
                        }
                        
                 
                    }
                    $request->session()->flash('alert-success', 'Teacher was successful added!');
                    return redirect()->back();
                }
            }
    }
    
    
    
    
    
    public function create()
    {
        return view('add-teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|max:255|unique:teachers',
            'password' => 'required|string|min:6',

        ], [

      
            
            

        ]);
        
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->username = $request->username;
        $teacher->password = Hash::make($request->password);
        $teacher->role = 'teacher';
        
     
        
        if ($teacher->save()){

            $teachers = Teacher::where('name','=',$request->name)->get();

            $teacher_profile = new Teacher_Profile();
            $teacher_profile->teacher_id = $teachers->get(0)['id'];
            $teacher_profile->profile_pic = 'noimage.jpg';
            $teacher_profile->bio = 'add a bio';
            $teacher_profile->save();
            $request->session()->flash('alert-success', 'Teacher was successful added!');
        return redirect()->route('admin.teacher.index');
        }
        else{
            return redirect()->route('/admin/add-teacher/create');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = Teacher::where('id','=',$id)->get();
        return view('admin.edit-teacher',['teachers'=>$teachers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|max:255|max:255',
            'password' => 'required|string|min:6',

        ], [

      
            
            

        ]);
        $teachers = Teacher::find($id);
        $teachers->name = $request->name;
        $teachers->username = $request->username;
        $teachers->password = Hash::make($request->password);
        $teachers->role = 'teacher';
        $teachers->save();
        $request->session()->flash('alert-success', 'Teacher was successful updated!');
        return redirect()->route('admin.teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $teacher = Teacher::find($id);
      if($teacher->delete()){
        $request->session()->flash('alert-success', 'Account was successful deleted!');
        return redirect()->route('admin.teacher.index');
 
      }
   
        
    }

    public function view($id)
    {
        $classes = AddClass::with('teachers')->get();
        $teacher = Teacher::get();
        $subjects = AddSubject::get();
        $teachers = Teacher::where('id','=',$id)->get();
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('teacher_id','=',$id)->get();
  
        return view('admin.view-teacher',['classes'=>$classes,'teacher'=>$teacher,'subjects'=>$subjects,'teachers'=>$teachers,'class_subject_teachers'=>$class_subject_teachers]);
    }

    public function view_excel($id)
    {
        $classes = AddClass::with('teachers')->get();
        $subjects = AddSubject::get();
        $teachers = Teacher::where('id','=',$id)->get();
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('teacher_id','=',$id)->get();
  
        $subject_array[] = array('Subjects','Year','Section','Section Name','School Year','Schedule');
        foreach($class_subject_teachers as $class_subject_teacher){
            $subject_array[] = array(
                'Subjects' => $class_subject_teacher->subjects->get(0)->title,
                'Year' => $class_subject_teacher->classes->get(0)->year,
                'Section' => $class_subject_teacher->classes->get(0)->section,
                'Section Name' => $class_subject_teacher->classes->get(0)->section_name,
                'School Year' => $class_subject_teacher->classes->get(0)->school_year,
                'Schedule' => $class_subject_teacher->schedule,
            );
        }
 
        $teacher_array[] = array('Teacher Name');
        $teacher_array[] = array(
             'Teacher Name' => $teachers->get(0)->name,
            
        );
 
 
        Excel::create('Teacher Schedule', function($excel) use ($subject_array,$teacher_array){
         $excel->setTitle('Teacher Schedule');
         $excel->sheet('Teacher Schedule', function($sheet) use ($subject_array,$teacher_array){
         $sheet->fromArray($teacher_array, null, 'A1', false, false);
         $sheet->fromArray($subject_array, null, '', false, false);
         });
        })->download('xlsx');
        
     }
    

    public function schedule_update(Request $request,$id)
    {
        $input = request()->validate([
            'year' => 'required|string|max:255',
            'section' => 'required|max:255',
            'school_year' => 'required|string|max:255',
            'schedule' => 'required|max:255',
            'section_name' => 'required|string|max:255',
            'subject_id' => 'required|max:255',
        ], [

      
            
            

        ]);
        $year = $request->year;
        $section = $request->section;
        $school_year = $request->school_year;
        
        $classes = AddClass::where('year','=',$year)
        ->where('section','=',$section)
        ->where('school_year','=',$school_year)
        ->get();

        $addclass = Class_Subject_Teacher::find($id);
        $addclass->class_id =$classes->get(0)->id;
        $addclass->subject_id=$request->subject_id;
        $addclass->schedule=$request->schedule;
        $addclass->save();
        $request->session()->flash('alert-success', 'Successfully edited!');
        return back();
    }

    public function schedule_delete($id, Request $request){
        
        $class_subject_teachers = Class_Subject_Teacher::find($id);
       if( $class_subject_teachers->delete()){
        $request->session()->flash('alert-success', 'Schedule Successfully deleted!');
        return back();
       }
     
       
    }

    public function addsubject(Request $request,$id){
        $input = request()->validate([
            'year' => 'required|string|max:255',
            'section' => 'required|max:255',
            'school_year' => 'required|string|max:255',
            'schedule' => 'required|max:255',
            'section_name' => 'required|string|max:255',
            'subject_id' => 'required|max:255',
        ], [

      
            
            

        ]);
       

        $year = $request->year;
        $section = $request->section;
        $school_year = $request->school_year;
        
        $classes = AddClass::where('year','=',$year)
        ->where('section','=',$section)
        ->where('school_year','=',$school_year)
        ->get();


        $class_subject_teacher = new Class_Subject_Teacher();
        $class_subject_teacher->class_id = $classes->get(0)->id;
        $class_subject_teacher->subject_id = $request->subject_id;
        $class_subject_teacher->teacher_id = $id;
        $class_subject_teacher->schedule = $request->schedule;
        $class_subject_teacher->save();
        $request->session()->flash('alert-success', 'Successfully added!');
        return back();
      
    }
}
