<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Class_Subject_Teacher;
use App\Exam;
use App\Question;
use Illuminate\Http\Request;
use Session;

    

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

   
    public function index($id)
    {
        $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
        return view('teacher.create-question', ['exams'=>$exams]);
    }
  
    public function store(Request $request,$id)
    {
    
        $input = request()->validate([
            'score' => 'required',
            'question' => 'required',
            'answer' => 'required',
        
        ], [
    
       
           
            
            
    
        ]);
       
        $question = new Question();
            $question->exam_id = $id;
            $question->question = $request->question;
            $question->score = $request->score;
            $question->option_1 = $request->option_1;
            $question->option_2 = $request->option_2;
            $question->option_3 = $request->option_3;
            $question->option_4 = $request->option_4;
            $question->option_5 = $request->option_5;
            $question->answer = $request->answer;
            $question->save();
            $request->session()->flash('alert-success', 'Question Successfully Created!');
    
            return redirect()->back();


           
    }

    public function show($id){
        $questions = Question::with('exams')->where('exam_id',$id)->get();
        $exams = Exam::with('class_subject_teachers')->where('id',$questions->first()->exam_id)->get();
        return view('teacher.question-show',['questions'=>$questions,'exams'=>$exams]);
    }

    public function edit($id){
        $questions = Question::with('exams')->where('id',$id)->get();
        $exams = Exam::with('class_subject_teachers')->where('id',$questions->first()->exam_id)->get();
        return view('teacher.question-edit',['questions'=>$questions,'exams'=>$exams]);
    }
    

    public function update(Request $request,$id)
    {
        $input = request()->validate([
            'score' => 'required',
            'question' => 'required',
            'answer' => 'required',
        
        ], [
    
       
           
            
            
    
        ]);
       
        $question = Question::find($id);
            $question->exam_id = $id;
            $question->question = $request->question;
            $question->score = $request->score;
            $question->option_1 = $request->option_1;
            $question->option_2 = $request->option_2;
            $question->option_3 = $request->option_3;
            $question->option_4 = $request->option_4;
            $question->option_5 = $request->option_5;
            $question->answer = $request->answer;
            $question->save();
            $request->session()->flash('alert-success', 'Question Successfully Updated!');

            $questions = Question::with('exams')->where('exam_id',$id)->get();
            return redirect()->route('questions.show',['id'=>$question->exam_id]);
           
    }

    
    public function delete($id,Request $request)
    {
        $questions = Question::with('exams')->where('exam_id',$id)->get();
        $questions = Question::find($id);
        if($questions->delete()){
            $request->session()->flash('alert-success', 'Question Successfully Deleted!');
            return redirect()->back();
        }
       
   
    }
}
