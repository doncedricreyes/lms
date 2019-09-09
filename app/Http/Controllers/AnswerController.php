<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Student;
use App\Exam_Grade;
use App\Exam;
use App\Quiz_Attempt;
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
    $quiz_attempt = Quiz_Attempt::with('exams','students')->where('student_id',auth::user()->id)->where('exam_id',$id)->latest('id')->first();
    $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)->get();  
    $exams = Exam::where('id','=',$id)->get();
   
    
         

        
        $answer = new Answer();
        $answer->quiz_attempt_id = $quiz_attempt->id;
        $answer->answer = $request->answer;
        $answer->question_id = $request->id;

        if($exams->get(0)->attempts >= $attempt){
        $answer->save();
        return redirect()->route('student.show.question',['id'=>$id]);
        }
        else{
            return redirect()->back()->withErrors('You have already attempted this exam/quiz!');
        }    

   
   }

   
   
}
