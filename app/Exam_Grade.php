<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam_Grade extends Model 
{
    protected $table = 'exam_grade';
    
   

    public function students()
    {
        return $this->hasMany(Student::class,'id','student_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class,'id','exam_id');
    }
}
