<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Event;
use Calendar;
use Auth;
use Validator;
use Redirect;
class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student,teacher,admin');
    }

    public function index(){
        $i = Auth::user()->id;
        if(Auth::user()->role =='student'){
        $events = Event::where('student_id','=',$i)->get();
        }
        if(Auth::user()->role =='teacher'){
            $events = Event::where('teacher_id','=',$i)->get();
            }
            if(Auth::user()->role =='admin'){
                $events = Event::where('admin_id','=',$i)->get();
                }
        $event_list = [];
        foreach($events as $key =>$event){
            $event_list[] = Calendar::event(
                $event->event_name,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day')
            
            );
        }
        $calendar_details = Calendar::addEvents($event_list);

        return view('calendar',compact('calendar_details'));
    }

    
    
     
    public function addevent(Request $request){

      

      

        $event = new Event;
        $event->event_name = $request->event_name;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        if (\Route::current()->getName() == 'student.add_event') {
            $event->student_id = Auth::user()->id;
          }
          if (\Route::current()->getName() == 'teacher.add_event') {
            $event->teacher_id = Auth::user()->id;
          }
          if (\Route::current()->getName() == 'admin.add_event') {
            $event->admin_id = Auth::user()->id;
          }
        $event->save();

        $request->session()->flash('alert-success', 'Event was successful created!');
        return redirect()->back();
    }
}

