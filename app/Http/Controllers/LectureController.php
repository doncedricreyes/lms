<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Class_Subject_Teacher;
use Illuminate\Http\Request;
use App\Lecture;
use App\Class_Student;
use Notification;
use App\Notifications\LectureAdded;

    

class LectureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    
    public function index()
    {
        
    
    
    }

    public function store( Request $request,$id)
    {
        $input = request()->validate([
            'quarter' => 'required',
            'file_title' => 'required',
            'file_name' => 'required|mimes:zip,rar,tar,gzip,mp3,mpeg,wav,ogg,jpeg,jpg,png,bmp,gif,txt,WebM,MPEG4,3GPP,MOV,AVI,MPEGPS,WMV,FLV,ogg
            ,doc,docx,xls,xlsx,ppt,pptx,xps,pdf,dxf,ai,psd,eps,ps,svg,tif,tiff,ttf|max:50000',

        ], [

       
            'file_name.mimes' => 'Invalid Format',
           'file_name.max' => 'File is too big',
            
            

        ]);

   
            if ($request->hasFile('file_name')) {
                $filenameWithExt = $request->file('file_name')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('file_name')->getClientOriginalExtension();
                $fileNametoStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('file_name')->storeAs('storage/lectures',$fileNametoStore);
                
            }
          
    
      
           
            $lecture = new Lecture();
            $lecture->class_subject_teacher_id = $id;
            $lecture->quarter = $request->quarter;
            $lecture->file_title = $request->file_title;
            $lecture->file_name = $fileNametoStore;
    
            $lecture->save();
            $request->session()->flash('alert-success', 'Lecture Successfully Added!');
            $students = Class_Student::with('class_subject_teachers','students')->where('class_subject_teacher_id','=',$id)->get();
            foreach($students as $student){
            Notification::route('mail',$student->students->get(0)->email)->notify(new LectureAdded($lecture));
            }
            return redirect()->route('subject.index',['id'=>$id]);
            
    }
  
}
