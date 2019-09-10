<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Class_Subject_Teacher;
use App\Exam;
use App\Class_Student;
use App\Question;
use App\Exam_Grade;
use App\Answer;
use App\Quiz_Attempt;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\QuizCreated;
use Session;

    

class ExamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

   
    public function index($id)
    {
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$id)->get();
        return view('teacher.create-exam', ['class_subject_teachers' => $class_subject_teachers]);
    }
    public function store(Request $request,$id)
    {

        $input = request()->validate([
            'quarter' => 'required',
            'title' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'total_score' => 'required',
            'passing_score' => 'required',
            'attempts' => 'required',
            'time' => 'required',
        ], [
    
       
           
            
            
    
        ]);
        $quarter = $request->quarter;
$exams = Exam::with('class_subject_teachers')->where('quarter','=',$quarter)
->where('class_subject_teacher_id','=',$id)
->get();

            if($exams->count() < 10){
        $exam = new Exam();
            $exam->class_subject_teacher_id = $id;
            $exam->quarter = $request->quarter;
            $exam->title = $request->title;
            $exam->date_start = $request->date_start;
            $exam->date_end = $request->date_end;
            $exam->total_score = $request->total_score;
            $exam->passing_score = $request->passing_score;
            $exam->attempts = $request->attempts;
            $exam->time = $request->time*60;
            $exam->save();
            $request->session()->flash('alert-success', 'Exam/Quiz Successfully Created!');
            $students = Class_Student::with('class_subject_teachers','students')->where('class_subject_teacher_id','=',$id)->get();
            foreach($students as $student){
            Notification::route('mail',$student->students->get(0)->email)->notify(new QuizCreated($exam));
            }
            return redirect()->route('subject.index',['id'=>$id]);
            }
            else{
                return redirect()->back()->withErrors('Only 10 quizzes/exams are allowed per quarter!');
            }
    }

    public function show($id)
    {
        $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
   
        return view('teacher.exam-show', ['exams' => $exams]);
    }

    public function edit($id)
    {
        $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
        return view('teacher.exam-edit', ['exams' => $exams]);
    }

    public function update(Request $request,$id)
    {
        $input = request()->validate([
            'quarter' => 'required',
            'title' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'total_score' => 'required',
            'passing_score' => 'required',
            'attempts' => 'required',
            'time' => 'required',
        ], [
    
       
           
            
            
    
        ]);

        $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
foreach($exams as $class_subject_teacher_id){
        $exam =  Exam::find($id);
        $exam->class_subject_teacher_id = $class_subject_teacher_id->class_subject_teacher_id;
        $exam->quarter = $request->quarter;
        $exam->title = $request->title;
        $exam->date_start = $request->date_start;
        $exam->date_end = $request->date_end;
        $exam->total_score = $request->total_score;
        $exam->passing_score = $request->passing_score;
        $exam->attempts = $request->attempts;
        $exam->time = $request->time*60;
        $exam->save();
        $request->session()->flash('alert-success', 'Quiz/Exam Successfully Updated!');
}
        return redirect()->route('exam.show',['id'=>$id]);
    }
   

        
   public function delete($id)
   {
       $exam = Exam::with('class_subject_teachers')->where('id',$id)->first();
       $exams = Exam::find($id);
       $exams->delete();
       return redirect()->route('subject.index',['id'=>$exam->class_subject_teacher_id]);
  
   }

   public function item_analysis(Request $request,$id){
    $questions = Question::with('exams')->where('exam_id',$id)->get();
   
    $students = Quiz_Attempt::with('exams','students')->where('exam_id',$id)->where('attempt',$request->attempt)->distinct('student_id')->count();
    $exams = Exam::where('id',$id)->get();
    $quiz_attempt = Quiz_Attempt::with('exams','students')->where('exam_id',$id)->where('attempt',$request->attempt)->get();

    $row=[];
    $row2=[];
    $row3=[];
    $row4=[];
    $row5=[];
    $row6=[];
    $row7=[];
    $row8=[];
    $row9=[];
    $row10=[];
    $row11=[];
    $row12=[];
    
    foreach($questions as $question){
    $option_1 = Answer::with('students','exams','questions')
    ->where('quiz_attempt_id',$quiz_attempt->get(0)['id'])
    ->where('question_id',$question->id)
    ->where('answer',$question->option_1)
    ->count();
    $average_1 = ($option_1/$students)*100;
    $row[] = $option_1;
    $row2[]=$average_1;
    
    $option_2 = Answer::with('students','exams','questions')
    ->where('quiz_attempt_id',$quiz_attempt->get(0)['id'])
    ->where('question_id',$question->id)
    ->where('answer',$question->option_2)
    ->count();
    $average_2 = ($option_2/$students)*100;
    $row3[] = $option_2;
    $row4[]=$average_2;

    $option_3 = Answer::with('students','exams','questions')
    ->where('quiz_attempt_id',$quiz_attempt->get(0)['id'])
    ->where('question_id',$question->id)
    ->where('answer',$question->option_3)
    ->count();
    $average_3 = ($option_3/$students)*100;
    $row5[] = $option_3;
    $row6[]=$average_3;

    $option_4 = Answer::with('students','exams','questions')
    ->where('quiz_attempt_id',$quiz_attempt->get(0)['id'])
    ->where('question_id',$question->id)
    ->where('answer',$question->option_4)
    ->count();
    $average_4 = ($option_4/$students)*100;
    $row7[] = $option_4;
    $row8[]=$average_4;

    $option_5 = Answer::with('students','exams','questions')
    ->where('quiz_attempt_id',$quiz_attempt->get(0)['id'])
    ->where('question_id',$question->id)
    ->where('answer',$question->option_5)
    ->count();
    $average_5 = ($option_5/$students)*100;
    $row9[] = $option_5;
    $row10[]=$average_5;

    $correct = Answer::with('students','exams','questions')
    ->where('quiz_attempt_id',$quiz_attempt->get(0)['id'])
    ->where('question_id',$question->id)
    ->where('answer',$question->answer)
    ->count();
    $average_6 = ($correct/$students)*100;
    $row11[] = $correct;
    $row12[]=$average_6;

    }


    $collection = collect([$row]);
    $option1 = $collection->flatten();
    $option1->all();
  
    $collection2 = collect([$row2]);
    $avg1 = $collection2->flatten();
    $avg1->all();
   
    $collection3 = collect([$row3]);
    $option2 = $collection3->flatten();
    $option2->all();
   
    $collection4 = collect([$row4]);
    $avg2 = $collection4->flatten();
    $avg2->all();
   
    $collection5 = collect([$row5]);
    $option3 = $collection5->flatten();
    $option3->all();
   
    $collection6 = collect([$row6]);
    $avg3 = $collection6->flatten();
    $avg3->all();

    $collection7 = collect([$row7]);
    $option4 = $collection7->flatten();
    $option4->all();
   
    $collection8 = collect([$row8]);
    $avg4 = $collection8->flatten();
    $avg4->all();

    $collection9 = collect([$row9]);
    $option5 = $collection9->flatten();
    $option5->all();

    $collection10 = collect([$row10]);
    $avg5 = $collection10->flatten();
    $avg5->all();

    $collection11 = collect([$row11]);
    $answ = $collection11->flatten();
    $answ->all();

    $collection12 = collect([$row12]);
    $avg6 = $collection12->flatten();
    $avg6->all();

    $counter = 0;


    
    
    return view('teacher.item_analysis',['exams'=>$exams,'questions'=>$questions],compact('option1','avg1','option2','avg2','option3','avg3','option4','avg4','option5','avg5','counter','students','answ','avg6'));
   }
}
