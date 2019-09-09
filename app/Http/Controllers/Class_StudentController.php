<?php

namespace App\Http\Controllers;
use Auth;
use App\Student_Assignment;
use App\Subject_Announcement;
use App\Class_Announcement;
use App\Assignment;
use App\Class_Subject_Teacher;
use App\Class_Student;
use App\AddClass;
use App\Grade_Subject;
use App\Teacher;
use App\AddSubject;
use App\Question;
use App\Lecture;
use App\Exam;
use App\Student;
use App\Exam_Grade;
use App\Quiz_Attempt;
use App\Answer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class Class_StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student,parent');
    }

    public function subject_list()
    {
        $students = Auth::user()->id;
        $class_students = Class_Student::with('students','class_subject_teachers')->where('student_id',$students)->get();
        if(count($class_students)== 0){
            return redirect()->route('enroll');
        }
        
        return view('student.subject-list',['class_students'=>$class_students]);

    }

    public function showclass(Request $request)
    {
        $students = Auth::user()->id;

        $class_students = Class_Student::with('students','class_subject_teachers')->where('student_id',$students)->get();

        foreach($class_students as $class_student){
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$class_student->class_subject_teacher_id)->first();
    }
    $class_announcements = Class_Announcement::with('classes')->where('class_id','=',$class_subject_teachers->class_id)->get();
    $students = Class_Student::with('students','class_subject_teachers')->where('class_subject_teacher_id','=',$class_subject_teachers->id)->get()
    ->sortBy(function($students){
        return $students->students->get(0)->name;
    });
    $quarter=$request->quarter;
    $grade_subjects = Grade_Subject::with('students','class_subject_teachers')->where('student_id','=',Auth::user()->id)
    ->where('quarter','=',$quarter)
    ->get();
        if(count($class_students)== 0){
                return redirect()->route('enroll');
            }
            
       
            return view('student.class', ['grade_subjects'=>$grade_subjects,'students'=>$students,'class_announcements'=>$class_announcements,'class_subject_teachers'=>$class_subject_teachers,'students'=>$students,'class_students'=>$class_students]);
    }

    public function enroll()
    {
        $teachers = Teacher::all();
        $classes = AddClass::all();
    
        
        return view('enroll', ['teachers' => $teachers,'classes'=>$classes]);
    }
    public function store()
    {
     
    
     
        $year=Input::get('year');
        $section=Input::get('section');
        $section_name=Input::get('section_name');
        $adviser=Input::get('adviser');
        $enrollment_key=Input::get('enrollment_key');
       
            
            
            $classes =DB::table('classes')->where([
                ['year', '=', $year],
                ['section', '=', $section],
                ['section_name', '=', $section_name],
                ['adviser_id', '=', $adviser],
                ['enrollment_key', '=', $enrollment_key],

            ])->first()->id;
            
            if(count($classes)>0)
              {
                  
                $class_subject=DB::table('class_subject_teacher')->where([
                    [ 'class_id','=',$classes],
                 ])->get();
                 
                 foreach($class_subject as $class_id){
                 $class_student = new Class_Student();
                 $class_student->class_subject_teacher_id = $class_id->id;
                 $class_student->student_id = Auth::user()->id;
                 $class_student->save();
              
                 }
                 return redirect()->route('student.grade.show')->with('alert-success', 'Successfully Enrolled!');
          
            }
            return redirect()->back()->with('message', 'Class not found!');
            
       

           
    }
 
  
    public function subject(Request $request,$id)
    {
       
        $quarter=$request->quarter;
        $exam_grade_all=[];
        $assignment_grade_all=[];
      
        $quiz_attempts = Quiz_Attempt::with('exams','students')->where('student_id','=',auth::user()->id)->get();
        $students = Student::where('id',Auth::user()->id)->get();
        $subject_announcements = Subject_Announcement::with('class_subject_teachers')->where('class_subject_teacher_id','=',$id)->get();
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$id)->get();
        $class_students = Class_student::with('class_subject_teachers','students')->where('class_subject_teacher_id',$id)->get()
        ->sortBy(function($class_students){
            return $class_students->students->get(0)->name;
        });
        foreach($class_subject_teachers as $class_subject_teacher){
        $lectures = Lecture::with('class_subject_teachers')->where('class_subject_teacher_id',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        $assignments = Assignment::with('class_subject_teachers')->where('class_subject_teacher_id','=',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        $exams = Exam::with('class_subject_teachers')->where('class_subject_teacher_id',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        }
        
      
        
            foreach($quiz_attempts as $quiz_attempt){

        $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)
        ->get();
    
        $exam_grade_all[] = $exam_grades;
    }

    $collection = collect([$exam_grade_all]);
    $subject_grade = $collection->flatten();
    $subject_grade->all();

 
    foreach($assignments as $assign){
        $student_assignments = Student_Assignment::with('assignments','students')->where('student_id','=',Auth::user()->id)
        ->where('assignment_id','=',$assign->id)
        ->get();
        $assignment_grade_all[]=$student_assignments;
    }
    $collection = collect([$assignment_grade_all]);
    $student_assignment = $collection->flatten();
    $student_assignment->all();   

        return view('student.subject',compact('student_assignment','exam_grades','subject_grade','assignments','subject_announcements','students','class_subject_teachers','lectures','class_students','exams'));
      
    }

    
    public function exam($id)
    {
       $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
        $quiz_attempt = Quiz_Attempt::with('exams','students')->where('student_id','=',auth::user()->id)->where('exam_id','=',$id)->get();
        $quiz_latest = Quiz_Attempt::with('exams','students')->where('student_id','=',auth::user()->id)->where('exam_id','=',$id)->latest('id')->first();
        $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id',$quiz_latest->first()->id)->latest('id')->first();

        return view('student.exam', compact('exams','exam_grades','quiz_attempt','quiz_latest'));
    }
    
       public function quiz_start($id, Request $request)
    {         
       $quiz_attempts = Quiz_Attempt::where('student_id',auth::user()->id)->where('exam_id',$id)->latest('id')->first();
       $attempt=1;
       if(count($quiz_attempts)> 0){
           $attempt = $quiz_attempts->attempt+1;
       }
        $quiz_attempt = new Quiz_Attempt;
        $quiz_attempt->student_id = auth::user()->id;
        $quiz_attempt->exam_id = $id;
        $quiz_attempt->attempt = $attempt;
        $quiz_attempt->time_start = Carbon::now('Asia/Manila');
        $quiz_attempt->save();
        return redirect()->route('student.show.question',['id'=>$id]);
    }

        
    public function question($id)
    {
        $questions = Question::with('exams')->where('exam_id',$id)->get();
       
        $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
        $quiz_start = Quiz_Attempt::with('exams','students')->where('exam_id','=',$id)->where('student_id','=',auth::user()->id)->latest('id')->first();
      
        $answers = Answer::with('questions','quiz_attempt')->where('quiz_attempt_id',$quiz_start->id)->pluck('answer','question_id');
      
        $start = $quiz_start->time_start;
        
        
        $time_start = Carbon::createFromFormat('Y-m-d H:i:s', $start);
        $now = Carbon::now('Asia/Manila');
        $time_now = Carbon::createFromFormat('Y-m-d H:i:s', $now);
        $limit = $exams->get(0)->time;
        $time_remaining = $limit-$time_start->diffInSeconds($time_now);
        return view('student.exam-show',['answers'=>$answers,'questions'=>$questions,'exams'=>$exams,'quiz_attempt'=>$quiz_start,'time_remaining'=>$time_remaining,'time_start'=>$time_start,'time_now'=>$time_now,'limit'=>$limit]);
    }

    public function showassignment($id){
        $student_assignments = Student_Assignment::with('students','assignments')->where('assignment_id',$id)
        ->where('student_id','=',Auth::user()->id)
        ->get();
        $assignments = Assignment::with('class_subject_teachers')->where('id',$id)->get();
        return view('student.assignment-show',['assignments'=>$assignments,'student_assignments'=>$student_assignments]);
    }

 
  public function grade($id){
 
    
    $class_students = Class_Student::with('students','class_subject_teachers')->where('student_id','=',Auth::user()->id)->get();
    if(count($class_students)== 0){
        return redirect()->route('enroll');
    }
      return view('student.grade',['class_students'=>$class_students]);
      
  }

  public function schedule($id){

      $schedules = Class_Student::with('class_subject_teachers','students')->where('student_id',auth::user()->id)->get();
      return view('student.schedule',compact('schedules'));
  }
   
    
}
