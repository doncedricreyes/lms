<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade_Subject extends Model 
{
    protected $table = 'grade_subject';

   

    public function class_subject_teachers()
    {
        return $this->belongsTo(Class_Subject_Teacher::class,'class_subject_teacher_id','id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'id','student_id');
    }

}
