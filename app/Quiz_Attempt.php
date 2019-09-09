<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_Attempt extends Model 
{
    protected $table = 'quiz_attempt';
    public $timestamps = false;
   

  

    public function exams()
    {
        return $this->hasMany(Exam::class,'id','exam_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'id','student_id');
    }
    public function answers(){
        return $this->belongsTo(Answer::class);
    }

    public function exam_grades(){
        return $this->belongsTo(Exam_Grade::class);
    }
}
