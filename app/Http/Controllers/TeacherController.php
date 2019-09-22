<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Student_Assignment;
use App\Subject_Announcement;
use App\Student;
use App\Class_Announcement;
use App\AddClass;
use App\Assignment;
use App\Exam_Grade;
use App\Class_Subject_Teacher;
use App\Class_Student;
use App\Exam;
use App\Lecture;
use App\Quiz_Attempt;
use Auth;
use Hash;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher');
    }

    public function class()
    {
        $teacherId = Auth::user()->id;
     
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('teacher_id',$teacherId)->get();
        foreach($class_subject_teachers as $class_subject_teacher){
        $class_subject_teacher_id=$class_subject_teacher->id;
    
        }
        $class_students = Class_Student::with('students','class_subject_teachers')->where('class_subject_teacher_id',$class_subject_teacher_id)->get()->count();
        
        return view('teacher.class',['class_subject_teachers'=>$class_subject_teachers,'class_students'=>$class_students]);
    }

    public function subject(Request $request,$id)
    {
        $quarter= $request->quarter;
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$id)->get();
        $subject_announcements = Subject_Announcement::with('class_subject_teachers')->where('class_subject_teacher_id','=',$id)->orderBy('updated_at')->get();
        $class_students = Class_student::with('class_subject_teachers','students')->where('class_subject_teacher_id',$id)->get()
        ->sortBy(function($class_students){
            return $class_students->students->get(0)->name;
        });
        foreach($class_subject_teachers as $class_subject_teacher){
        $lectures = Lecture::with('class_subject_teachers')->where('class_subject_teacher_id',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        $exams = Exam::with('class_subject_teachers')->where('class_subject_teacher_id',$class_subject_teacher->id)
        ->where('quarter','=',$quarter)
        ->get();
        }
        $assignments = Assignment::with('class_subject_teachers')->where('class_subject_teacher_id',$id)
        ->where('quarter','=',$quarter)
        ->get();
        

        return view('teacher.subject',['subject_announcements'=>$subject_announcements,'assignments'=>$assignments,'class_subject_teachers'=>$class_subject_teachers,'lectures'=>$lectures,'class_students'=>$class_students,'exams'=>$exams]);
      
    }

    public function showresult(Request $request,$id){
        
          $attempt = $request->attempt;
          $quiz_attempts = Quiz_Attempt::with('exams','students')->where('exam_id',$id)->where('attempt',$attempt)->get()
        ->sortBy(function($quiz_attempts){
            return $quiz_attempts->students->get(0)->name;
        });
        foreach($quiz_attempts as $quiz_attempt){
        $exam_grades = Exam_Grade::with('quiz_attempt')->where('quiz_attempt_id','=',$quiz_attempt->id)
           ->get();
    
           $grades[] = $exam_grades;
        }
        $exams = Exam::with('class_subject_teachers')->where('id',$id)->get();
     
        return view('teacher.exam-results',['exams'=>$exams],compact('grades'));
    }


    

    public function grade_subject_update(Request $request,$id){
        $input = request()->validate([
            'quarter'=>'required',

           

        ]);
        
       
        $class_student = Class_Student::find($request->id); 
            if($request->quarter == '1'){
         $class_student->first = $request->grade;
         $class_student->save(); 
            }
            if($request->quarter == '2'){
                $class_student->second = $request->grade;
                $class_student->save(); 
                   }
                   if($request->quarter == '3'){
                    $class_student->third = $request->grade;
                    $class_student->save(); 
                       }
                       if($request->quarter == '4'){
                        $class_student->fourth = $request->grade;
                        $class_student->save(); 
                           }
                           if($request->quarter == 'final'){
                            $class_student->final = $request->grade;
                            $class_student->save(); 
                               }
        
        $request->session()->flash('alert-success', 'Grade Successfully Updated!');
        return redirect()->back();
    }


      public function grade_index(Request $request,$subject,$id){
        $quarter = $request->quarter;
        $exams = Exam::with('class_subject_teachers')->where('class_subject_teacher_id','=',$subject)
        ->where('quarter','=',$quarter)
        ->get();
        $exam_grade_all=[];
        $assignment_grade_all=[];
        $quiz_attempt=[];
        foreach($exams as $exam){
            $quiz_attempts = Quiz_Attempt::with('exams','students')->where('exam_id',$exam->id)
                ->where('student_id',$id)
                ->get();
            $quiz_attempt[]=$quiz_attempts;
        }
        $collection = collect([$quiz_attempt]);
        $attempts = $collection->flatten();
        $attempts->all();
        foreach($attempts as $attempt){
        $exam_grades = Exam_Grade::with('quiz_attempt')
        ->where('quiz_attempt_id','=',$attempt->id)
        ->get();
        $exam_grade_all[] = $exam_grades;
        }

        $collection = collect([$exam_grade_all]);
        $subject_grade = $collection->flatten();
        $subject_grade->all();
        
        $assignments = Assignment::with('class_subject_teachers')->where('class_subject_teacher_id','=',$subject)
        ->where('quarter','=',$quarter)
        ->get();
        foreach($assignments as $assign){
            $student_assignments = Student_Assignment::with('assignments','students')->where('student_id','=',$id)
            ->where('assignment_id','=',$assign->id)
            ->get();
            $assignment_grade_all[]=$student_assignments;
        }
        $collection = collect([$assignment_grade_all]);
        $assignment = $collection->flatten();
        $assignment->all();
        $class_students = Class_Student::with('class_subject_teachers','students')->where('class_subject_teacher_id','=',$subject)
        ->where('student_id','=',$id)
        ->get();
        return view('teacher.grade',['class_students'=>$class_students,'exams'=>$exams,'subject_grade'=>$subject_grade,'assignment'=>$assignment,'assignments'=>$assignments]);
    }


    public function adviser(){
        $classes = AddClass::with('teachers')->where('adviser_id','=',Auth::user()->id)->get();
       
            $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('class_id','=',$classes->get(0)['id'])->get();
            $class_announcements = Class_Announcement::with('classes')->where('class_id','=',$classes->get(0)['id'])->orderBy('updated_at')->get();
        
        
        $class_students = Class_Student::with('students','class_subject_teachers')->where('class_subject_teacher_id','=',$class_subject_teachers->get(0)['id'])->get()
            ->sortBy(function($class_students){
                return $class_students->students->get(0)['name'];
            });
      
     if($classes->isEmpty()){
                 return redirect()->route('teachers.subject');
     }
     else{
      

         return view('adviser.class',['class_announcements'=>$class_announcements,'classes'=>$classes,'class_subject_teachers'=>$class_subject_teachers,'class_students'=>$class_students]);
         
     }  
     
   
    }
    public function adviser_grade(Request $request,$id){
            $class_students = Class_Student::with('students','class_subject_teachers')->where('student_id','=',$id)->get();
    
        return view('adviser.grade',['class_students'=>$class_students]);
    }

    public function announcement_create(){
        $classes = AddClass::with('teachers')->where('adviser_id','=',Auth::user()->id)->get();
        return view('adviser.announcement-create',['classes'=>$classes]);
    }

    public function announcement_store(Request $request,$id){
        $announcement = new Class_Announcement();
        $announcement->class_id = $id;
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->save();
        $request->session()->flash('alert-success', 'Announcement Successfully Created!');
        return redirect()->route('adviser.show');
    }

    public function announcement_edit($id){
        $class_announcements = Class_Announcement::with('classes')->where('id','=',$id)->get();
      return view('adviser.announcement-edit',['class_announcements'=>$class_announcements]);
    }

    
    public function announcement_update(Request $request,$id){
        $announcement = Class_Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->save();
        $request->session()->flash('alert-success', 'Announcement Successfully Edited!');
        return redirect()->route('adviser.show');
    }

    public function announcement_destroy(Request $request,$id){
     
        $announcement = Class_Announcement::find($id);
     
       if($announcement->delete())
       {
             $request->session()->flash('alert-success', 'Announcement Successfully Deleted!');
             return redirect()->back();
       }
     
    }






    public function subject_announcement_create($id){
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('teacher_id','=',Auth::user()->id)
        ->where('id','=',$id)
        ->get();
        return view('teacher.announcement-create',['class_subject_teachers'=>$class_subject_teachers]);
    }

    public function subject_announcement_store(Request $request,$id){
        $announcement = new Subject_Announcement();
        $announcement->class_subject_teacher_id = $id;
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $request->session()->flash('alert-success', 'Announcement Successfully Created!');
        $announcement->save();
        return redirect()->route('subject.index',['id'=>$id]);
    }

    public function subject_announcement_edit($id){
        $subject_announcements = Subject_Announcement::with('class_subject_teachers')->where('id','=',$id)->get();
      return view('teacher.announcement-edit',['subject_announcements'=>$subject_announcements]);
    }

    
    public function subject_announcement_update(Request $request,$id){
        $announcement = Subject_Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $request->session()->flash('alert-success', 'Announcement Successfully Edited!');
        $announcement->save();

        $subject_announcements = Subject_Announcement::where('id','=',$id)->first();
        $i = $subject_announcements->class_subject_teacher_id;
        return redirect()->route('subject.index',['id'=>$i]);
    }

    public function subject_announcement_destroy(Request $request,$id){
     
        $announcement = Subject_Announcement::find($id);
     
        if($announcement->delete()){
            $request->session()->flash('alert-success', 'Announcement Successfully Deleted!');
            return redirect()->back();
        }
      
    }

    public function account()
    {
        $i = Auth::user()->id;
        $teacher = Teacher::where('id','=',$i)->get();
        return view('teacher.account',['teacher'=>$teacher]);
    }

    public function edit_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:teachers',
        ], [
  

        ]);
  

        $i = Auth::user()->id;
        $teacher = Teacher::find($i);
        $teacher->email = $request->email;
        $teacher->save();
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
        $teacher = Teacher::find($i);
        $teacher->password = Hash::make($request['password']);
        $teacher->save();
        $request->session()->flash('alert-success', 'Password successfully updated!');
        return redirect()->back();
    }
  
    public function grade_excel($id){
        
        $class_students = Class_Student::with('class_subject_teachers','students')
        ->where('class_subject_teacher_id','=',$id)
        ->get()
        ->sortBy(function($class_students){
            return $class_students->students->get(0)->name;
        });

        $class_subject_teachers = Class_Subject_Teacher::where('id',$id)->first();

        $grades[] = array('name','1st grading','2nd grading','3rd grading','4th grading','final');
        foreach($class_students as $grade){
        $grades[] = array(
             'name' => $grade->students->get(0)->name,
             '1st grading' => $grade->first,
             '2nd grading' => $grade->second,
             '3rd grading' => $grade->third,
             '4th grading' => $grade->fourth,
             'final' => $grade->final,
        );
    }
    $subject[] = array('subject','year','section');
    $subject[] = array(
         'subject' => $class_subject_teachers->subjects->get(0)->title,
         'year' => $class_subject_teachers->classes->get(0)->year,
         'section' => $class_subject_teachers->classes->get(0)->section,
    );

 
        Excel::create('Grades', function($excel) use ($grades,$subject){
         $excel->setTitle('Grades');
         $excel->sheet('Grades', function($sheet) use ($grades,$subject){
         $sheet->fromArray($subject, null, 'A1', false, false);
         $sheet->fromArray($grades, null, '', false, false);
         });
        })->download('xlsx');
    }
}
