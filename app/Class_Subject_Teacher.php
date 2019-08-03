<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_Subject_Teacher extends Model
{
        //
 
        protected $table = 'class_subject_teacher';
        public $timestamps = false;
    
    
    
       public function teachers()
       {
           return $this->hasMany(Teacher::class,'id','teacher_id');
       }
        
    
       public function subjects()
       {
           return $this->hasMany(AddSubject::class,'id','subject_id');
       }
       public function classes()
       {
           return $this->hasMany(AddClass::class,'id','class_id');
       }
    
       public function class_students()
       {
        return $this->belongsTo(Class_Student::class);
       }
       public function lectures()
       {
           return $this->hasMany(Lecture::class);
       }

       public function exams()
       {
           return $this->hasMany(Exam::class);
       }

       public function assignments()
       {
           return $this->hasMany(Assignment::class);
       }

       public function grade_subjects()
       {
           return $this->hasMany(Grade_Subject::class);
       }

       
    public function subject_announcement(){
        return $this->hasMany(Subject_Announcement::class);
    }
       
}

