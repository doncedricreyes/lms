<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Student;
use App\Exam_Grade;
use App\Exam;
use Auth;

use Illuminate\Http\Request;

class AnswerController extends Controller
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

   public function store(Request $request,$id)
   {
    $questions = Question::with('exams')->where('exam_id',$id)->get();
    $exam_grades = Exam_Grade::with('exams','students')->where('student_id','=',Auth::user()->id)->where('exam_id','=',$id)->get();  
    $exams = Exam::where('id','=',$id)->get();
   
    if(count($exam_grades)>0){
        foreach($exam_grades as $exam_attempt){
    $attempt=$exam_attempt->attempt+1;
        }
    }
    else{
        $attempt=1;
    }
         

        
        $answer = new Answer();
        $answer->student_id = Auth::user()->id;
        $answer->answer = $request->answer;
        $answer->question_id = $request->id;
        $answer->exam_id=$id;
        $answer->attempt = $attempt;

        if($exams->get(0)->attempts >= $attempt){
        $answer->save();
        return redirect()->route('student.show.question',['id'=>$id]);
        }
        else{
            return redirect()->back()->withErrors('You have already attempted this exam/quiz!');
        }    

   
   }

   
   
}
