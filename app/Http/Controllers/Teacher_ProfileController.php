<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Class_Subject_Teacher;
use App\Teacher_Profile;
use App\Teacher;
use Auth;
use Image;
use Carbon\Carbon;
use DB;



class Teacher_ProfileController extends Controller
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
        
        $this->validate($request,[
            
         
           
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $profile = Profile::where('student_id',$id)->get();
        
        return view('admin.profile')->with('profiles', $profile);
    
    }
    
    public function index($id)
    {
      
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('teacher_id','=',$id)->get();
        $profiles = Teacher_Profile::with('teachers')->where('teacher_id',$id)->get();
        return view('teacher.profile',['profiles'=>$profiles,'class_subject_teachers'=>$class_subject_teachers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher_id = Auth::user()->id;
        $teacher_profiles = Teacher_Profile::with('teachers')->where('teacher_id',$teacher_id)->get();
        return view('teacher.edit-profile', ['teacher_profiles'=>$teacher_profiles]);
      
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
        $this->validate($request,[
            
         
           
            ]);
            
 
            

    
    
            $teacher_profile = Teacher_Profile::find($id); 
             $teacher_profile->teacher_id = Auth::user()->id;
             $teacher_profile->bday = $request->bday;
            
             $myDate = $request->bday;

             $years = \Carbon::parse($myDate)->age;
          
             $teacher_profile->age = $years;
             $teacher_profile->address = $request->address;
             $teacher_profile->phone_no = $request->phone_no;
             $teacher_profile->cp_no = $request->cp_no;
             $teacher_profile->gender = $request->gender;
             $teacher_profile->bio = $request->bio;
    
          
    
            $teacher_profile->save();
            $request->session()->flash('alert-success', 'Successfully updated!');
            $i = Auth::user()->id;
            return redirect()->route('teacher.profile.index',['id'=>$i]);
            
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
            $profile = Teacher_Profile::find($id); 
            $profile->profile_pic = $fileNametoStore;
            $profile->save();
            $request->session()->flash('alert-success', 'Successfully updated!');
            $i = Auth::user()->id;
            return redirect()->route('teacher.profile.index',['id'=>$i]);
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

