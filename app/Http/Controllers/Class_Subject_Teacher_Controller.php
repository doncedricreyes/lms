<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Class_Subject_Teacher;
use App\AddClass;
use App\Teacher;
use App\AddSubject;
use App\Student;
use Session;

class Class_Subject_Teacher_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        $classes = AddClass::all();
        $subjects = AddSubject::all();
  

        
        return view('admin.view-class', ['teachers' => $teachers,'classes'=>$classes,'subjects'=>$subjects,'class_subject_teachers'=>$class_subject_teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $input = request()->validate([
            'subject_id' => 'required|unique:class_subject_teacher,subject_id',
            'teacher_id' => 'required',
            'schedule' => 'required|unique:class_subject_teacher,schedule',
        ], [

            'subject_id.required'=>'Subject is already created',
            'teacher_id'=>'Teacher field is required',
        ]);
   
            $addclass = new Class_Subject_Teacher();
            $adviserID = $request->get('adviser_id');
            $addclass->class_id=$request->class_id;
            $addclass->subject_id=$request->subject_id;
            $addclass->teacher_id=$request->teacher_id;
            $addclass->schedule=$request->schedule;
            $addclass->save();
            $request->session()->flash('alert-success', 'Successfully created!');
            return redirect()->route('add-class.show',['id'=>$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $addclass = Class_Subject_Teacher::find($id);
        $teacher = $request->get('teacher_id');
        $addclass->subject_id=$request->subject_id;
        $addclass->teacher_id=$teacher;
        $addclass->schedule=$request->schedule;
        $addclass->save();
        $request->session()->flash('alert-success', 'Successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $class_subject_teachers = Class_Subject_Teacher::find($id);
        if($class_subject_teachers->delete()){
            $request->session()->flash('alert-success', 'Successfully deleted!');
            return redirect()->back();
        }
        
    }
}
