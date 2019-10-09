<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Parents;
use App\Teacher;
use App\Student;
use App\Message;
use Notification;
use App\Notifications\NewMessage;

use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student,admin,teacher,parent');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $parents = Parents::where('id','=',$id)->get();
        $teachers = Teacher::where('id','=',$id)->get();
        $students = Student::where('id','=',$id)->get();
        $admins = Admin::where('id','=',$id)->get();
     

        if(Auth::user()->role == 'student'){
        return view('student.message',['parents'=>$parents,'students'=>$students,'teachers'=>$teachers]);
        }
        if(Auth::user()->role == 'teacher'){
       
          return view('teacher.message',['parents'=>$parents,'students'=>$students,'teachers'=>$teachers]);
          }
          if(Auth::user()->role == 'parent'){
            return view('parent.message',['parents'=>$parents,'students'=>$students,'teachers'=>$teachers]);
            }
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
              return view('admin.message',['parents'=>$parents,'students'=>$students,'teachers'=>$teachers,'admins'=>$admins]);
              }
    }

    public function store(Request $request,$id){
           $input = request()->validate([
        'message_title' => 'required|string|max:255',
        'message_body' => 'required|string|max:255',

    ], [

  
        
        

    ]);
      $parents = Parents::where('id','=',$id)->get();
      $teachers = Teacher::where('id','=',$id)->get();
      $students = Student::where('id','=',$id)->get();
      $admins = Admin::where('id','=',$id)->get();
        $sender_name = Auth::user()->name;
        $sender_id = Auth::user()->id;
        $messages = new Message();
         if(Auth::user()->role == "student"){
            
            $messages->sender_student_id = $sender_id;
            
         }
         if(Auth::user()->role == "teacher"){
            
            $messages->sender_teacher_id = $sender_id;
            
         }
         if(Auth::user()->role == "parent"){
            
            $messages->sender_parent_id = $sender_id;
            
         }
         if(Auth::user()->role == "admin" || Auth::user()->role == "superadmin"){
            
            $messages->sender_admin_id = $sender_id;
            
         }


         if (\Route::current()->getName() == 'message.store') {
            $messages->recipient_student_id = $id;
          }
          if (\Route::current()->getName() == 'teacher.student.message.store') {
            $messages->recipient_student_id = $id;
          }
          if (\Route::current()->getName() == 'teacher.parent.message.store') {
            $messages->recipient_parent_id = $id;
          }
          if (\Route::current()->getName() == 'message.teacher.store') {
            $messages->recipient_teacher_id = $id;
          }
          if (\Route::current()->getName() == 'teacher.message.store') {
            $messages->recipient_teacher_id = $id;
          }
          if (\Route::current()->getName() == 'parent.message.teacher.store') {
            $messages->recipient_teacher_id = $id;
          }
          if (\Route::current()->getName() == 'parent.message.student.store') {
            $messages->recipient_student_id = $id;
          }
          if (\Route::current()->getName() == 'admin.student.message.store') {
            $messages->recipient_student_id = $id;
          }
          if (\Route::current()->getName() == 'admin.teacher.message.store') {
            $messages->recipient_teacher_id = $id;
          }
          if (\Route::current()->getName() == 'admin.parent.message.store') {
            $messages->recipient_parent_id = $id;
          }
          if (\Route::current()->getName() == 'admin.message.store') {
            $messages->recipient_admin_id = $id;
          }


        
    
    


          
    $messages->message_title=$request->message_title;
    $messages->message_body=$request->message_body;
    $messages->save();
  

       if (\Route::current()->getName() == 'message.store') {
      if($students != null){
      foreach($students as $student){
        Notification::route('mail',$student->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'teacher.student.message.store') {
      if($students != null){
      foreach($students as $student){
        Notification::route('mail',$student->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'teacher.parent.message.store') {
      if($parents != null){
      foreach($parents as $parent){
        Notification::route('mail',$parent->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'message.teacher.store') {
      if($teachers != null){
      foreach($teachers as $teacher){
        Notification::route('mail',$teacher->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'teacher.message.store') {
      if($teachers != null){
      foreach($teachers as $teacher){
        Notification::route('mail',$teacher->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'parent.message.teacher.store') {
      if($teachers != null){
      foreach($teachers as $teacher){
        Notification::route('mail',$teacher->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'admin.student.message.store') {
      if($students != null){
      foreach($students as $student){
        Notification::route('mail',$student->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'admin.teacher.message.store') {
      if($teachers != null){
      foreach($teachers as $teacher){
        Notification::route('mail',$teacher->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'admin.parent.message.store') {
      foreach($parents as $parent){
        Notification::route('mail',$parent->email)->notify(new NewMessage($messages));
        }
    }
    if (\Route::current()->getName() == 'parent.message.student.store') {
      if($students != null){
      foreach($students as $student){
        Notification::route('mail',$student->email)->notify(new NewMessage($messages));
        }
      }
    }
    if (\Route::current()->getName() == 'admin.message.store') {
      if($admins != null){
      foreach($admins as $admin){
        Notification::route('mail',$admin->email)->notify(new NewMessage($messages));
        }
      }
    }
   

    $request->session()->flash('alert-success', 'Message was successful sent!');
    return redirect()->back();


    }

 public function student_inbox($id)
    {
   $message_recipient = Message::with('student','teacher','parent','admin')->where('recipient_student_id','=',Auth::user()->id)->where('remove_recipient','=',NULL)
   ->orderBy('created_at','DESC')
   ->paginate(8);
   $message_sender = Message::with('students','teachers','parents','admins')->where('sender_student_id','=',Auth::user()->id)
   ->orderBy('created_at','DESC')
   ->paginate(8); 
 

   return view('student.inbox',['message_recipient'=>$message_recipient,'message_sender'=>$message_sender]);
        
    }

    public function message_inbox_delete($id, Request $request)
    {
      $message = Message::find($id);
      $message->remove_recipient = 1;
      $message->save();
      $request->session()->flash('alert-success', 'Message successfully removed!');
      return redirect()->back();
        
    }

    public function teacher_inbox($id)
    {
   $message_recipient = Message::with('student','teacher','parent','admin')->where('recipient_teacher_id','=',Auth::user()->id)->where('remove_recipient','=',NULL)
   ->orderBy('created_at','DESC')
   ->paginate(10);
   $message_sender = Message::with('students','teachers','parents','admins')->where('sender_teacher_id','=',Auth::user()->id)
   ->orderBy('created_at','DESC')
   ->paginate(10);
 

   return view('teacher.inbox',['message_recipient'=>$message_recipient,'message_sender'=>$message_sender]);
        
    }

    
  

    public function parent_inbox($id)
    {
   $message_recipient = Message::with('student','teacher','parent','admin')->where('recipient_parent_id','=',Auth::user()->id)->where('remove_recipient','=',NULL)
   ->orderBy('created_at','DESC')
   ->paginate(10);
   $message_sender = Message::with('students','teachers','parents','admins')->where('sender_parent_id','=',Auth::user()->id)
   ->orderBy('created_at','DESC')
   ->paginate(10); 
 

   return view('parent.inbox',['message_recipient'=>$message_recipient,'message_sender'=>$message_sender]);
        
    }

    

   

    public function admin_inbox($id)
    {
   $message_recipient = Message::with('student','teacher','parent','admin')->where('recipient_admin_id','=',Auth::user()->id)->where('remove_recipient','=',NULL)
   ->orderBy('created_at','DESC')
   ->paginate(10);
   $message_sender = Message::with('students','teachers','parents','admins')->where('sender_admin_id','=',Auth::user()->id)
   ->orderBy('created_at','DESC')
   ->paginate(10);
 

   return view('admin.inbox',['message_recipient'=>$message_recipient,'message_sender'=>$message_sender]);
        
    }





    public function student_show($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)
   ->orderBy('created_at','DESC')
   ->get();
   return view('student.message-show',['messages'=>$messages]);
        
    }
    public function teacher_show($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)
   ->orderBy('created_at','DESC')
   ->get();
   return view('teacher.message-show',['messages'=>$messages]);
        
    }

    public function parent_show($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)
   ->orderBy('created_at','DESC')
   ->get();
   return view('parent.message-show',['messages'=>$messages]);
        
    }

    public function admin_show($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)
   ->orderBy('created_at','DESC')
   ->get();
   return view('admin.message-show',['messages'=>$messages]);
        
    }









    public function student_reply($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)->get();
   return view('student.message-reply',['messages'=>$messages]);
        
    }

    public function teacher_reply($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)->get();
   return view('teacher.message-reply',['messages'=>$messages]);
        
    }

    
    public function parent_reply($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)->get();
   return view('parent.message-reply',['messages'=>$messages]);
        
    }
    
    public function admin_reply($id,$inbox)
    {
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)->get();
   return view('admin.message-reply',['messages'=>$messages]);
        
    }

   
   
    public function reply_store(Request $request,$inbox)
    {
     
           $input = request()->validate([
        'message_title' => 'required|string|max:255',
        'message_body' => 'required|string|max:255',

    ], [

  
        
        

    ]);
   $messages = Message::with('student','teacher','parent','admin')->where('id','=',$inbox)->get();
      
   $sender_id = Auth::user()->id;
   $message = new Message();
   if(Auth::user()->role == "student"){
            
      $message->sender_student_id = $sender_id;
      
   }
   if(Auth::user()->role == "teacher"){
      
      $message->sender_teacher_id = $sender_id;
      
   }
   if(Auth::user()->role == "parent"){
      
      $message->sender_parent_id = $sender_id;
      
   }
   if(Auth::user()->role == "admin"){
      
      $message->sender_admin_id = $sender_id;
      
   }
   
   foreach($messages as $i){
   $message->recipient_student_id = $i->sender_student_id;
   $message->recipient_parent_id = $i->sender_parent_id;
   $message->recipient_teacher_id = $i->sender_teacher_id;
   $message->recipient_admin_id = $i->sender_admin_id;
   }
$message->message_title = $request->message_title;
$message->message_body = $request->message_body;
$message->save();
      $parents = Parents::where('id','=',$message->recipient_parent_id)->get();
      $teachers = Teacher::where('id','=',$message->recipient_teacher_id)->get();
      $students = Student::where('id','=',$message->recipient_student_id)->get();
      $admins = Admin::where('id','=',$message->recipient_admin_id)->get();
        if (\Route::current()->getName() == 'admin.message.reply.store') {
  foreach($admins as $admin){
    Notification::route('mail',$admin->email)->notify(new NewMessage($messages));
    }
}
if (\Route::current()->getName() == 'student.message.reply.store') {
  foreach($students as $student){
    Notification::route('mail',$student->email)->notify(new NewMessage($messages));
    }
}
if (\Route::current()->getName() == 'parent.message.reply.store') {
  foreach($parents as $parent){
    Notification::route('mail',$parent->email)->notify(new NewMessage($messages));
    }
}
if (\Route::current()->getName() == 'teacher.message.reply.store') {
  foreach($teachers as $teacher){
    Notification::route('mail',$teacher->email)->notify(new NewMessage($messages));
    }
}
$request->session()->flash('alert-success', 'Message was successful sent!');
return redirect()->back();
        
    }

public function student_sent_index($id){
      $message_sender = Message::with('students','teachers','parents','admins')->where('sender_student_id','=',Auth::user()->id)
      ->where('remove_sender','=',null)
      ->orderBy('created_at','DESC')
      ->paginate(10);


      return view('student.message_sent',['message_sender'=>$message_sender]);
    }

    public function message_sent_delete($id, Request $request)
    {
      $message = Message::find($id);
      $message->remove_sender = 1;
      $message->save();
      $request->session()->flash('alert-success', 'Message successfully removed!');
      return redirect()->back();
        
    }
    public function teacher_sent_index($id){
      $message_sender = Message::with('students','teachers','parents','admins')->where('sender_teacher_id','=',Auth::user()->id)
      ->where('remove_sender','=',null)
      ->orderBy('created_at','DESC')
      ->paginate(10);


      return view('teacher.message_sent',['message_sender'=>$message_sender]);
    }
    

    public function parent_sent_index($id){
      $message_sender = Message::with('students','teachers','parents','admins')->where('sender_parent_id','=',Auth::user()->id)
      ->where('remove_sender','=',null)
      ->orderBy('created_at','DESC')
      ->paginate(10);
      $message_recipient = Message::with('student','teacher','parent','admin')->where('sender_parent_id','=',Auth::user()->id)
      ->orderBy('created_at','DESC')
      ->paginate(10);

      return view('parent.message_sent',['message_recipient'=>$message_recipient,'message_sender'=>$message_sender]);
    }
    public function admin_sent_index($id){
      $message_sender = Message::with('students','teachers','parents','admins')->where('sender_admin_id','=',Auth::user()->id)
      ->where('remove_sender','=',null)
      ->orderBy('created_at','DESC')
      ->paginate(10);
      $message_recipient = Message::with('student','teacher','parent','admin')->where('sender_admin_id','=',Auth::user()->id)
      ->orderBy('created_at','DESC')
      ->paginate(10);

      return view('admin.message_sent',['message_recipient'=>$message_recipient,'message_sender'=>$message_sender]);
    }




    public function student_sent_show($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();
      $admins = Admin::where('id','=',$messages->get(0)['recipient_admin_id'])->get();
      $students = Student::where('id','=',$messages->get(0)['recipient_student_id'])->get();
      $teachers = Teacher::where('id','=',$messages->get(0)['recipient_teacher_id'])->get();
      $parents = Parents::where('id','=',$messages->get(0)['recipient_parent_id'])->get();

      return view('student.message_sent_show',['messages'=>$messages,'admins'=>$admins,'students'=>$students,'teachers'=>$teachers,'parents'=>$parents]);
    }

    public function parent_sent_show($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();
      $admins = Admin::where('id','=',$messages->get(0)->recipient_admin_id)->get();
      $students = Student::where('id','=',$messages->get(0)->recipient_student_id)->get();
      $teachers = Teacher::where('id','=',$messages->get(0)->recipient_teacher_id)->get();
      $parents = Parents::where('id','=',$messages->get(0)->recipient_parent_id)->get();

      return view('parent.message_sent_show',['messages'=>$messages,'admins'=>$admins,'students'=>$students,'teachers'=>$teachers,'parents'=>$parents]);
    }

    public function teacher_sent_show($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();
      $admins = Admin::where('id','=',$messages->get(0)->recipient_admin_id)->get();
      $students = Student::where('id','=',$messages->get(0)->recipient_student_id)->get();
      $teachers = Teacher::where('id','=',$messages->get(0)->recipient_teacher_id)->get();
      $parents = Parents::where('id','=',$messages->get(0)->recipient_parent_id)->get();

      return view('teacher.message_sent_show',['messages'=>$messages,'admins'=>$admins,'students'=>$students,'teachers'=>$teachers,'parents'=>$parents]);
    }
    public function admin_sent_show($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();
      $admins = Admin::where('id','=',$messages->get(0)->recipient_admin_id)->get();
      $students = Student::where('id','=',$messages->get(0)->recipient_student_id)->get();
      $teachers = Teacher::where('id','=',$messages->get(0)->recipient_teacher_id)->get();
      $parents = Parents::where('id','=',$messages->get(0)->recipient_parent_id)->get();

      return view('admin.message_sent_show',['messages'=>$messages,'admins'=>$admins,'students'=>$students,'teachers'=>$teachers,'parents'=>$parents]);
    }
    





    public function student_compose_index($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();

      return view('student.message_compose',['messages'=>$messages]);
    }

    public function parent_compose_index($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();

      return view('parent.message_compose',['messages'=>$messages]);
    }
    public function teacher_compose_index($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();

      return view('teacher.message_compose',['messages'=>$messages]);
    }
    public function admin_compose_index($id){
      $messages = Message::with('students','teachers','parents','admins')->where('id','=',$id)->get();

      return view('admin.message_compose',['messages'=>$messages]);
    }
    

    
    
    public function compose_store(Request $request,$id){
      
      $input = request()->validate([
        'message_title' => 'required|string|max:255',
        'message_body' => 'required|string|max:255',

    ], [

  
        
        

    ]);
       $sender_id = Auth::user()->id;
       $sender_role = Auth::user()->role;
       $name = $request->name;
       $role = $request->role;
       $student=Student::where('name','=',$name)
       ->where('role','=',$role)
       ->get();
       $parent=Parents::where('name','=',$name)
       ->where('role','=',$role)
       ->get();
       $teacher=Teacher::where('name','=',$name)
       ->where('role','=',$role)
       ->get();
       $admin=Admin::where('name','=',$name)
       ->where('role','=',$role)
       ->get();

       $sender_student=Student::where('id','=',$sender_id)
       ->where('role','=',$sender_role)
       ->get();
       $sender_parent=Parents::where('id','=',$sender_id)
       ->where('role','=',$sender_role)
       ->get();
       $sender_teacher=Teacher::where('id','=',$sender_id)
       ->where('role','=',$sender_role)
       ->get();
       $sender_admin=Admin::where('id','=',$sender_id)
       ->where('role','=',$sender_role)
       ->get();




       $messages = new Message();
       if ($student) {
          $messages->recipient_student_id = $student->get(0)['id'];
        }
        if ($parent) {
         $messages->recipient_parent_id = $parent->get(0)['id'];
       }
       if ($teacher) {
         $messages->recipient_teacher_id = $teacher->get(0)['id'];
       }
       if ($admin) {
         $messages->recipient_admin_id = $admin->get(0)['id'];
       }

       if ($sender_student) {
         $messages->sender_student_id = $sender_student->get(0)['id'];
       }
       if ($sender_parent) {
        $messages->sender_parent_id = $sender_parent->get(0)['id'];
      }
      if ($sender_teacher) {
        $messages->sender_teacher_id = $sender_teacher->get(0)['id'];
      }
      if ($sender_admin) {
        $messages->sender_admin_id = $sender_admin->get(0)['id'];
      }
     $messages->message_title = $request->message_title;
$messages->message_body = $request->message_body;
$messages->save();
         $parents = Parents::where('id','=',$messages->recipient_parent_id)->get();
$teachers = Teacher::where('id','=',$messages->recipient_teacher_id)->get();
$students = Student::where('id','=',$messages->recipient_student_id)->get();
$admins = Admin::where('id','=',$messages->recipient_admin_id)->get();
        if (\Route::current()->getName() == 'admin.message.compose.store') {
  foreach($admins as $admin){
    Notification::route('mail',$admin->email)->notify(new NewMessage($messages));
    }
}
if (\Route::current()->getName() == 'student.message.compose.store') {
  foreach($students as $student){
    Notification::route('mail',$student->email)->notify(new NewMessage($messages));
    }
}
if (\Route::current()->getName() == 'parent.message.compose.store') {
  foreach($parents as $parent){
    Notification::route('mail',$parent->email)->notify(new NewMessage($messages));
    }
}
if (\Route::current()->getName() == 'teacher.message.compose.store') {
  foreach($teachers as $teacher){
    Notification::route('mail',$teacher->email)->notify(new NewMessage($messages));
    }
}
$request->session()->flash('alert-success', 'Message was successful sent!');
return redirect()->back();
    }


    public function student_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('student.inbox.show',['id'=>$id]);
    }

    public function student_sent_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('student.message.sent.index',['id'=>$id]);
    }

    
    public function teacher_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('teacher.inbox.show',['id'=>$id]);
  
    }

    public function teacher_sent_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('teacher.message.sent.index',['id'=>$id]);
  
    }


    public function parent_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('parent.inbox.show',['id'=>$id]);
  
    }

    public function parent_sent_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('parent.message.sent.index',['id'=>$id]);
    }

    
    public function admin_delete($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('admin.inbox.show',['id'=>$id]);
    }

    public function admin_sent_delete($id)
    {
 
        $messages = Message::find($id);
        $messages->delete();
        $i=Auth::user()->id;
        return redirect()->route('admin.message.sent.index',['id'=>$id]);
  
    }

}
