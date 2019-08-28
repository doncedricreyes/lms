<?php

namespace App\Http\Controllers;
use App\Student_Assignment;
use App\Student;
use App\Assignment;
use Auth;

use Illuminate\Http\Request;

class Student_AssignmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student,teacher');
    
    }

  
   public function store(Request $request,$id)
   {
    $input = request()->validate([
       
        'file_title' => 'required',
        'file' => 'required|mimes:zip,rar,tar,gzip,mp3,mpeg,wav,ogg,jpeg,jpg,png,bmp,gif,txt,WebM,MPEG4,3GPP,MOV,AVI,MPEGPS,WMV,FLV,ogg
        ,doc,docx,xls,xlsx,ppt,pptx,xps,pdf,dxf,ai,psd,eps,ps,svg,tif,tiff,ttf|max:50000',

    ], [

   
        'file.mimes' => 'Invalid Format',
       'file.max' => 'File is too big',
        
        

    ]);
        
    if ($request->hasFile('file')) {
        $filenameWithExt = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileNametoStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('file')->storeAs('public/assignments',$fileNametoStore);
        
    }

        
        $student_assignment = new Student_Assignment();
        $student_assignment->student_id = Auth::user()->id;
        $student_assignment->file = $fileNametoStore;
        $student_assignment->assignment_id = $id;
        $student_assignment->save();
        $request->session()->flash('alert-success', 'Assignment Successfully Submitted!');
        return redirect()->back();
   
     
   }

  
   public function show($id){
       
    $student_assignments = Student_Assignment::with('students','assignments')->where('assignment_id',$id)->get()
    ->sortBy(function($student_assignments){
        return $student_assignments->students->get(0)->name;
        
    });
       foreach($student_assignments as $student_assignment){
    $assignments = Assignment::with('class_subject_teachers')->where('id','=',$student_assignment->assignments->get(0)['id'])->get();
       }
 
    return view('teacher.assignment-result',compact('assignments','student_assignments');
}
}
