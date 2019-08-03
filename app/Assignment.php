<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    use Notifiable;
    protected $table = 'assignments';
    


public function class_subject_teachers(){
     
    return $this->belongsTo(Class_Subject_Teacher::class,'class_subject_teacher_id','id');
    
}

public function student_assignments(){
    return $this->hasMany(Student_Assignment::class);
}
  
}
