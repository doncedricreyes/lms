<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use App\Student_Assignment;
use App\Profile;
use App\Exam_Grade;
use App\Class_Announcement;
use App\Subject_Announcement;
use App\Lecture;
use App\Exam;
use App\Assignment;
use App\Class_Subject_Teacher;
use App\Class_Student;
use App\AddClass;
use App\Student;  
use App\Parents;  
use Illuminate\Support\Facades\DB;
use App\Teacher;
use App\Quiz_Attempt;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:parent');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parent');
    }

    
    public function enrollment(){
        $teachers = Teacher::all();
        return view('parent.enrollment',['teachers' => $teachers]);
    }

    public function enrollment_store(Request $request){
        $year = $request->year;
        $section = $request->section;
        $section_name = $request->section_name;
        $adviser_id = $request->adviser;
        $parent_key = $request->parent_key;
        $school_year = $request->school_year;
        $student_id = $request->student;
        
        $students = Student::where('name','=',$student_id)->first();

        $classes = AddClass::with('teachers')->where('year','=',$year)
        ->where('section','=',$section)
        ->where('section_name','=',$section_name)
        ->where('adviser_id','=',$adviser_id)
        ->where('parent_key','=',$parent_key)
        ->first();

        if(count($classes)>0)
        {
                $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('class_id','=',$classes->id)->get();

                foreach($class_subject_teachers as $class){
                $class_students = Class_Student::with('class_subject_teachers','students')->where('class_subject_teacher_id','=',$class->id)
                ->where('student_id','=',$students->id)->get();
               
              
                foreach($class_students as $class_student){
                    $id = $class_student->id;
                $class_student = Class_Student::find($id);
                $class_student->student_id = $class_student->student_id;
                $class_student->class_subject_teacher_id = $class_student->class_subject_teacher_id;
                $class_student->parent_id = Auth::user()->id;
                $class_student->save();
                }
            }
        }
        else{
            return redirect()->back()->withErrors('Class/Student not found.');
        }
        
        return redirect()->back();
      

    }

    public function class()
    {
        $i = Auth::user()->id;
        $class_students = Class_Student::with('students','class_subject_teachers')->where('parent_id','=', $i)->get()->unique('student_id');
        foreach($class_students as $class_student){
            $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$class_student->class_subject_teacher_id)->get();
        }
        if(count($class_students)== 0){
            return redirect('parent/enrollment');
        }
        return view('parent.class',['class_students'=>$class_students,'class_subject_teachers'=>$class_subject_teachers]);
    }
    
    public function class_id(Request $request, $id){
        $class_students = Class_Student::with('students','class_subject_teachers')->where('parent_id','=',Auth::user()->id)
        ->where('student_id','=',$id)
        ->get();
        $quarter=$request->quarter;
        foreach($class_students as $class_student){ 
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$class_student->class_subject_teacher_id)->first();
        }
        $class_announcements = Class_Announcement::with('classes')->where('class_id','=',$class_subject_teachers->class_id)->get();
        $students = Class_Student::with('students','class_subject_teachers')->where('class_subject_teacher_id','=',$class_subject_teachers->id)->get();
     
     
      
        return view('parent.class_id',['students'=>$students,'class_announcements'=>$class_announcements,'class_subject_teachers'=>$class_subject_teachers,'students'=>$students,'class_students'=>$class_students]);
    
}

      public function subject(Request $request,$student,$id){

        
        $quarter=$request->quarter;
        $exam_grade_all=[];
        $assignment_grade_all=[];
        $qattempts_all=[];
            
      
        $students = Student::where('id',$student)->get();
        $subject_announcements = Subject_Announcement::with('class_subject_teachers')->where('class_subject_teacher_id','=',$id)->get();
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$id)->get();

        foreach($class_subject_teachers as $class_subject_teacher){

        $assignments = Assignment::with('class_subject_teachers')->where('class_subject_teacher_id','=',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        $exams = Exam::with('class_subject_teachers')->where('class_subject_teacher_id',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        }
        
          foreach($exams as $exam){
            $qattempts = Quiz_Attempt::with('exams','students')->where('student_id','=',$student)->where('exam_id',$exam->id)->get();
            $qattempts_all[] = $qattempts;
        }
        $collection = collect([$qattempts_all]);
        $quiz_attempts = $collection->flatten();
        $quiz_attempts->all();
          
        foreach($quiz_attempts as $quiz_attempt){

        $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)
        ->get();
    
        $exam_grade_all[] = $exam_grades;
    }

    $collection = collect([$exam_grade_all]);
    $subject_grade = $collection->flatten();
    $subject_grade->all();

 
    foreach($assignments as $assign){
        $student_assignments = Student_Assignment::with('assignments','students')->where('student_id','=',$student)
        ->where('assignment_id','=',$assign->id)
        ->get();
        $assignment_grade_all[]=$student_assignments;
    }
    $collection = collect([$assignment_grade_all]);
    $student_assignment = $collection->flatten();
    $student_assignment->all();   

        return view('parent.subject',['student_assignment'=>$student_assignment,'quiz_attempts'=>$quiz_attempts,'subject_grade'=>$subject_grade,'assignments'=>$assignments,'subject_announcements'=>$subject_announcements,'students'=>$students,'exam_grades'=>$exam_grades,'class_subject_teachers'=>$class_subject_teachers,'exams'=>$exams]);
      
    }

    public function assignment($id)
    {
        $class_students = Class_Student::where('parent_id','=',Auth::user()->id)->first();
        $student_assignments = Student_Assignment::with('students','assignments')
        ->where('id',$id)
        ->where('student_id',$class_students->student_id)
        ->get();
        $assignments = Assignment::with('class_subject_teachers')->where('id',$id)->get();
    
        return view('parent.assignment-show',['student_assignments'=>$student_assignments,'assignments'=>$assignments]);
    }
    
    
    public function grade_student($id){
        
        $class_students = Class_student::with('class_subject_teachers','students')
        ->where('student_id','=',$id)
        ->get();

        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')
        ->where('id','=',$class_students->get(0)->class_subject_teacher_id)
        ->get();
       
            
                return view('parent.grade_student',['class_subject_teachers'=>$class_subject_teachers,'class_students'=>$class_students]);
            }

    public function grade_index(){
$i =Auth::user()->id;
        $students = Class_Student::with('students','class_subject_teachers')->where('parent_id','=',$i)->get()->unique('student_id');
    
        return view('parent.grade',['students'=>$students]);
    }

    public function grade($student,$id){
       

        $students = Class_Student::with('students','class_subject_teachers')->where('student_id','=',$student)
        ->whereHas('class_subject_teachers', function ($q) use($id){
            $q->where('class_id', $id);
        })->get();
   
            
                return view('parent.grade-view',['students'=>$students]);
            }

    public function student_profile($id)
    {
        $class_students = Class_Student::with('students','class_subject_teachers')->where('student_id',$id)->get()->unique('student_id');
        $students = Student::where('id','=',$id)->get();
        $profiles = Profile::with('students')->where('student_id',$id)->get();
        return view('student_profile',['students'=>$students,'profiles'=>$profiles,'class_students'=>$class_students]);
    }

    public function account()
    {
        $i = Auth::user()->id;
        $parent = Parents::where('id','=',$i)->get();
        return view('parent.account',['parent'=>$parent]);
    }

    public function edit_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:parents',
        ], [
  

        ]);
        $i = Auth::user()->id;
        $parent = Parents::find($i);
        $parent->email = $request->email;
        $parent->save();
        $request->session()->flash('alert-success', 'Email successfully updated!');
        return redirect()->back();
    }

    public function edit_pass(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ], [
  

        ]);

        $i = Auth::user()->id;
        $parent = Parents::find($i);
        $parent->password = Hash::make($request['password']);
        $parent->save();
        $request->session()->flash('alert-success', 'Password successfully updated!');
        return redirect()->back();
    }
}
