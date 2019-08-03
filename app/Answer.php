<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    public $timestamps = false;

public function students(){
     
    return $this->hasMany(Student::class,'id','student_id');
    
}
public function questions(){
     
    return $this->hasMany(Question::class,'id','question_id');
    
}
public function exams()
{
    return $this->hasMany(Exam::class,'id','exam_id');

}
  
}
