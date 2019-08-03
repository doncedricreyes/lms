<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_Announcement extends Model
{
    protected $table = 'subject_announcement';
    


public function class_subject_teachers(){
     
    return $this->belongsTo(Class_Subject_Teacher::class,'class_subject_teacher_id','id');
    
}


  
}
