<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Class_Student;
use App\Class_Subject_Teacher;
use App\Exam;
use App\Answer;
use App\Exam_Grade;
use App\Quiz_Attempt;
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
     
        
        $exams = Exam::with('class_subject_teachers')->where('id','=',$id)
        ->get();
        $quiz_attempt = Quiz_Attempt::with('exams','students')->where('student_id',auth::user()->id)->where('exam_id',$id)->latest('id')->first();
        $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)->get();
        $answers = Answer::where('quiz_attempt_id',$quiz_attempt->id)->get();
$attempt=1;
if(count($exam_grades)>0){
    foreach($exam_grades as $exam_attempt){
$attempt=$exam_attempt->attempt+1;
    }
}

$i=1;
$grade=0;
$final=0;
foreach($exams as $exam){
$passing = $exam->passing_score;
}
if(count($answers)>0){
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
    }
    else{
        $status = "Failed";
        $answer = new Answer();
        $answer->quiz_attempt_id = $quiz_attempt->id;
        $answer->save();    
   
    }
        $exam_grade=new Exam_Grade();
        $exam_grade->quiz_attempt_id = $quiz_attempt->id;
        $exam_grade->grade = $final;  
        $exam_grade->Status = $status;

        

        $exam_grade->save();
       
       return redirect()->route('student.show.result',['id'=>$id]);

            return redirect()->route('student.show.result',['id'=>$id])->withErrors('You have already attempted this exam/quiz!');
        

   }
    
   public function show($id){
  $quiz_attempts = Quiz_Attempt::with('exams','students')->where('student_id',auth::user()->id)->where('exam_id',$id)->get();
    
    foreach($quiz_attempts as $quiz_attempt){
    $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)
       ->get();

       $grades[] = $exam_grades;
    }
     

   
       return view('student.exam-results',['exam_grades'=>$exam_grades],compact('grades'));

       
   }

   public function parent_show($id){
       $class_students = Class_Student::where('parent_id','=',Auth::user()->id)->first();
       $quiz_attempts = Quiz_Attempt::with('exams','students')->where('student_id',$class_students->student_id)->where('exam_id',$id)->get();
       foreach($quiz_attempts as $quiz_attempt){
       $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)->get();
       $grades[] = $exam_grades;

    }
    return view('parent.exam-results',['exam_grades'=>$exam_grades],compact('grades'));
}


}
