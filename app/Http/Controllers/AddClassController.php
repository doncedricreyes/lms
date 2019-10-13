<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\AddClass;
use App\Teacher;
use App\AddSubject;
use App\Student;
use App\Class_Subject_Teacher;
use Session;
use Excel;


class AddClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
   
    
    public function index()
    {
        $teachers = Teacher::all();

        $classes = AddClass::all();
      

        return view('admin.create-class', ['teachers' => $teachers,'classes'=>$classes]);
       

    }

    public function class_excel(){

        $classes = AddClass::with('teachers')->get();

        $classes_array[] = array('school year','year','section','section name','adviser','time','room');
        foreach($classes as $class){
        $classes_array[] = array(
             'school year' => $class->school_year,
             'year' => $class->year,
             'section' => $class->section,
             'section name' => $class->section_name,
             'adviser' => $class->teachers->get(0)->name,
             'time' => $class->time,
             'room' => $class->room,
        );
    }
 
        Excel::create('Classes', function($excel) use ($classes_array){
         $excel->setTitle('Classes');
         $excel->sheet('Classes', function($sheet) use ($classes_array){
         $sheet->fromArray($classes_array, null, 'A1', false, false);
         });
        })->download('xlsx');
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
    public function store(Request $request)
    {
        $input = request()->validate([
            'adviser_id' => 'required|unique:classes,adviser_id',
            'year' => 'required|regex:/^[0-9]+$/u|max:2',
            'section' => 'required|regex:/^[0-9a-zA-Z]+$/u|max:2',
            'section_name' => 'required|regex:/^[a-zA-Z,. ]+$/u|max:255',
            'time' => 'required|regex:/^[a-zA-Z-0-9: ]+$/u',
            'room' => 'required|regex:/^[0-9]+$/u|max:3',
            'school_year' => 'required|regex:/^[0-9-a-zA-Z ]+$/u',
        ], [


        ]);

        $adviserID = $request->get('adviser_id');

            $addclass = new AddClass();
            $addclass->year=$request->year;
            $addclass->section=$request->section;
            $addclass->section_name=$request->section_name;
            $addclass->adviser_id=$adviserID;
            $addclass->time=$request->time;
            $addclass->room=$request->room;
            $addclass->school_year=$request->school_year;
            $addclass->save();
            $request->session()->flash('alert-success', 'Successfully created!');
            return redirect()->route('class.show');
         
        
          

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    
    {
        
        
        
        $teachers = Teacher::all();
        $classes = AddClass::with('teachers')->get();
        
        return view('admin.show-class', ['teachers' => $teachers,'classes'=>$classes]);
    }

    
 
    
  
    public function update(Request $request, $id)
    {
         $input = request()->validate([
            'adviser_id' => 'required',
            'year' => 'required|regex:/^[0-9]+$/u|max:2',
            'section' => 'required|regex:/^[0-9]+$/u|max:2',
            'section_name' => 'required|regex:/^[a-zA-Z,. ]+$/u|max:255',
            'time' => 'required|regex:/^[a-zA-Z-0-9: ]+$/u',
            'room' => 'required|regex:/^[0-9]+$/u|max:3',
            'school_year' => 'required|regex:/^[0-9-a-zA-Z ]+$/u',
        ], [


        ]);

            $adviserID = $request->get('adviser_id');


            $addclass = AddClass::find($id);
            $addclass->year=$request->year;
            $addclass->section=$request->section;
            $addclass->section_name=$request->section_name;
            $addclass->time=$request->time;
            $addclass->room=$request->room;
            $addclass->adviser_id=$adviserID;
            $addclass->school_year=$request->school_year;
            $addclass->save();
            $request->session()->flash('alert-success', 'Successfully updated!');
            return redirect()->back();
    }


    public function view($id)
    {
        
        $classes = AddClass::where('id',$id)->get();
        $subjects = AddSubject::all();
        $teachers = Teacher::all();
        $class_subject_teachers = Class_Subject_Teacher::with('teachers','subjects','classes')->where('class_id',$id)->get();
        

        return view('admin.view-class', ['classes'=>$classes,'teachers'=>$teachers,'subjects'=>$subjects,'class_subject_teachers'=>$class_subject_teachers]);
    
    }

    
 


    public function addsubjstore(Request $request)
    {

 
            
         
        
            $addclass = new AddClass();
            $adviserID = $request->get('adviser_id');

            $addclass = new AddClass();
            $addclass->year_and_section=$request->year_and_section;
            $addclass->adviser_id=$adviserID;
            $addclass->section_name=$request->section_name;
            $addclass->subject_id=$request->subject_id;
            $addclass->teacher_id=$request->teacher_id;
            $addclass->save();
            return redirect()->route('class.view');
    }

    public function destroy($id, Request $request)
    {
        $addclass = AddClass::find($id);
        if($addclass->delete()){
            $request->session()->flash('alert-success', 'Class successfully deleted!');
            return redirect()->route('class.show');
        }
    
    }

}
