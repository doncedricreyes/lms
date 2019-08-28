<?php

namespace App\Http\Controllers;
use App\Student;
use App\Assignment;
use App\Student_Assignment;
use App\Class_Subject_Teacher;
use App\Class_Student;
use Auth;
use Notification;
use App\Notifications\AssignmentCreated;
use App\Notifications\AssignmentGraded;


use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student,teacher');
    
    }

    public function index($id)
    {
        $class_subject_teachers = Class_Subject_Teacher::with('classes','subjects','teachers')->where('id',$id)->get();
        return view('teacher.assignment',['class_subject_teachers'=>$class_subject_teachers]);
    }
   public function store(Request $request,$id)
   {
    $input = request()->validate([
        'quarter' => 'required',
        'title' => 'required',
        'description' => 'required',
        'date_start' => 'required',
        'date_end' => 'required',
    ], [
  

    ]);
        
    $quarter = $request->quarter;
    $assignments = Assignment::with('class_subject_teachers')->where('quarter','=',$quarter)
    ->where('class_subject_teacher_id','=',$id)
    ->get();
    
                if($assignments->count() <= 10){
        
        $assignment = new Assignment();
        $assignment->class_subject_teacher_id = $id;
        $assignment->title = $request->title;
        $assignment->quarter = $request->quarter;
        $assignment->description = $request->description;
        $assignment->date_start = $request->date_start;
        $assignment->date_end = $request->date_end;
        $assignment->save();
         
        $students = Class_Student::with('class_subject_teachers','students')->where('class_subject_teacher_id','=',$id)->get();
        foreach($students as $student){
        Notification::route('mail',$student->students->get(0)->email)->notify(new AssignmentCreated($assignment));
        }
        $request->session()->flash('alert-success', 'Assignment Successfully Created!');
    
       
            return redirect()->route('subject.index',['id'=>$id]);
                }
                else{
                    return redirect()->back()->withErrors('Only 10 assignments are allowed per quarter!');
                }
   }

   public function show($id)
   {
       $assignments = Assignment::with('class_subject_teachers')->where('id',$id)->get();
       return view('teacher.assignment-show',['assignments'=>$assignments]);
   }

   
   public function edit($id)
   {
       $assignments = Assignment::with('class_subject_teachers')->where('id',$id)->get();
       return view('teacher.assignment-edit',['assignments'=>$assignments]);
   }

   
   public function update(Request $request,$id)
   {
       $assignments = Assignment::with('class_subject_teachers')->where('id',$id)->get();
foreach($assignments as $class_subject_teacher_id){
       $assignment =  Assignment::find($id);
       $assignment->class_subject_teacher_id = $class_subject_teacher_id->class_subject_teacher_id;
       $assignment->quarter = $request->quarter;
       $assignment->title = $request->title;
       $assignment->description = $request->description;
       $assignment->date_start = $request->date_start;
       $assignment->date_end = $request->date_end;
       $assignment->save();
       $request->session()->flash('alert-success', 'Assignment Successfully Edited!');
}
       return redirect()->route('assignment.show',['id'=>$id]);
   }

   public function grade(Request $request,$id)
   {

    $grades = $request->input('grades');
    foreach($grades as $row){
        $assignment_grade = Student_Assignment::find($row['id']); 
        $assignment_grade->assignment_id = $row['assignment_id']; 
        $assignment_grade->student_id = $row['student_id']; 
        $assignment_grade->grade = $row['grade'];
        $assignment_grade->file= $row['file'];
        $assignment_grade->save(); 
        
        $student_id = $row['student_id'];
        $students = Student::where('id',$student_id)->get();
        
        foreach($students as $student){
            Notification::route('mail',$student->email)->notify(new AssignmentGraded($assignment_grade));
            }
        $request->session()->flash('alert-success', 'Grade Successfully Edited!');
        
    }
    return redirect()->route('assignment.result',['id'=>$id]);
        
   }

     
   public function delete($id)
   {
    $assignments = Assignment::with('class_subject_teachers')->where('id',$id)->first();
       $assignments = Assignment::find($id);
       $assignments->delete();
       return redirect()->route('subject.index',['id'=>$assignments->class_subject_teacher_id]);
   }
   
}
