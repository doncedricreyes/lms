<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Student;
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
    
  
    
   
         

        
        $answer = new Answer();
        $answer->student_id = Auth::user()->id;
        $answer->answer = $request->answer;
        $answer->question_id = $request->id;
        $answer->exam_id=$id;
        $answer->save();
   
     
            return redirect()->route('student.show.question',['id'=>$id]);
            

   
   }

   
   
}
