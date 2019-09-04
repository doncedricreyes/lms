<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Class_Subject_Teacher;
use App\Teacher_Profile;    
use App\Profile;
use App\Class_Student;
use Auth;
use Image;
use Carbon\Carbon;
use DB;



class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student,admin,teacher,parent');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
         'profile_pic' => 'required|mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000',
         ],[
         
         ]);
        
        
        if ($request->hasFile('profile_pic')) {
            $filenameWithExt = $request->file('profile_pic')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            $fileNametoStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('profile_pic')->storeAs('public/images',$fileNametoStore);
            
        }
        else{
            $fileNametoStore = 'noimage.jpg';
            $path = $request->file('profile_pic')->storeAs('public/images',$fileNametoStore);
        }

  
    
       





        $profile = new Profile();
        $profile->address = $request->address;
        $profile->student_id = Auth::user()->id;
        $profile->profile_pic = $fileNametoStore;

        

        $profile->save();
       
        
    }

  
    public function show($id)
    {
        
        $profile = Profile::where('student_id',$id)->get();
        
        return view('admin.profile')->with('profiles', $profile);
    
    }
    
    public function student_show($id)
    {
        $class_students = Class_Student::with('students','class_subject_teachers')->where('student_id',$id)->get()->unique('student_id');
        $students = Student::where('id','=',$id)->get();
        $profiles = Profile::with('students')->where('student_id',$id)->get();
        return view('student_profile',['students'=>$students,'profiles'=>$profiles,'class_students'=>$class_students]);
    }

    public function teacher_show($id)
    {
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('teacher_id','=',$id)->get();
        $profiles = Teacher_Profile::with('teachers')->where('teacher_id',$id)->get();
        return view('teacher.profile',['profiles'=>$profiles,'class_subject_teachers'=>$class_subject_teachers]);
    }

 
    public function edit($id)
    {
        $studentId = Auth::user()->id;
        $profiles = Profile::where('student_id',$studentId)->get();
        return view('edit-profile', compact('profiles'));
        
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
     
         
    
      
        
           
    
    
    
    
    
            $profile = Profile::find($id); 
             $profile->student_id = Auth::user()->id;
             $profile->bday = $request->bday;
            
             $myDate = $request->bday;

             $years = \Carbon::parse($myDate)->age;
          
             $profile->age = $years;
             $profile->address = $request->address;
             $profile->phone_no = $request->phone_no;
             $profile->cp_no = $request->cp_no;
             $profile->gender = $request->gender;
             $profile->father_name = $request->father_name;
             $profile->father_email = $request->father_email;
             $profile->father_phone_no = $request->father_phone_no;
             $profile->father_cp_no = $request->father_cp_no;
             $profile->mother_name = $request->mother_name;
             $profile->mother_email = $request->mother_email;
             $profile->mother_phone_no = $request->mother_phone_no;
             $profile->mother_cp_no = $request->mother_cp_no;
             $profile->bio = $request->bio;
    
          
    
            $profile->save();
            $request->session()->flash('alert-success', 'Successfully updated!');
            $i = Auth::user()->id;
            return redirect()->route('student.profile',['id'=>$i]);
            
    }

    public function update_pic(Request $request, $id)
    {
        $input = request()->validate([
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           

        ], [

       
            'profile_pic.mimes' => 'Invalid Format',
           
            
            

        ]);
            
 
            
            if ($request->hasFile('profile_pic')) {
                $filenameWithExt = $request->file('profile_pic')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('profile_pic')->getClientOriginalExtension();
                $fileNametoStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('profile_pic')->storeAs('public/images',$fileNametoStore);
                
            }
            $profile = Profile::find($id); 
            $profile->profile_pic = $fileNametoStore;
               $profile->save();
            $request->session()->flash('alert-success', 'Successfully updated!');
            $i = Auth::user()->id;
            return redirect()->route('student.profile',['id'=>$i]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

