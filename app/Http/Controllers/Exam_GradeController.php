<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Class_Student;
use App\Class_Subject_Teacher;
use App\Exam;
use App\Answer;
use App\Exam_Grade;
use Auth;
use Illuminate\Http\Request;
use Session;

    

class Exam_GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student,parent');
    
    }
    public function store(Request $request,$id){
        $answers = Answer::with('questions','students')->where('student_id',Auth::user()->id)->where('exam_id',$id)->get();
        $exams = Exam::with('class_subject_teachers')->where('id','=',$id)
        ->get();
$i=1;
$grade=0;
$final=0;
foreach($exams as $exam){
$passing = $exam->passing_score;
}
        foreach($answers as $answer){
        
            if($answer->questions->get(0)->answer == $answer->answer){
                $grade=$grade+$answer->questions->get(0)->score;
                $final=$grade;
 
            }
        
            else{
                $final = $final;
                $grade = $grade;
            }
         if($grade >= $passing){
             $status = "Passed";
         }
         else{
             $status = "Failed";
         }
         if($grade ==0){
             $status = "Failed";
         }
            
        
       
        }
        $exam_grade=new Exam_Grade();
        $exam_grade->student_id = Auth::user()->id;
        $exam_grade->exam_id = $id;
        $exam_grade->grade = $final;  
        $exam_grade->Status = $status;
        $exam_grade->attempt = $i+$exam_grade->attempt;
       $exam_grade->save();
       
       return redirect()->route('student.show.result',['id'=>$id]);

   }
    
   public function show($id){
       $exam_grades = Exam_Grade::with('students','exams')->where('student_id','=',Auth::user()->id)
       ->where('exam_id','=',$id)
       ->get()
       ->sortBy(function($exam_grades){
        return $exam_grades->students->get(0)->name;
        
    });
   
       return view('student.exam-results',['exam_grades'=>$exam_grades]);
   }

   public function parent_show($id){
       $class_students = Class_Student::where('parent_id','=',Auth::user()->id)->first();
    $exam_grades = Exam_Grade::with('students','exams')->where('student_id','=',$class_students->student_id)
    ->where('exam_id','=',$id)
    ->get();

    return view('parent.exam-results',['exam_grades'=>$exam_grades]);
}
   
}
