<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Notifiable;
    protected $table = 'messages';
  
    public function students(){
        return $this->belongsTo(Student::class,'sender_student_id','id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'recipient_student_id','id');
    }

    
    public function teachers(){
        return $this->belongsTo(Teacher::class,'sender_teacher_id','id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class,'recipient_teacher_id','id');
    }

    
    public function parents(){
        return $this->belongsTo(Parents::class,'sender_parent_id','id');
    }
    public function parent(){
        return $this->belongsTo(Parents::class,'recipient_parent_id','id');
    }

    public function admins(){
        return $this->belongsTo(Admin::class,'sender_admin_id','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'recipient_admin_id','id');
    }

}
