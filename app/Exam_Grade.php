<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam_Grade extends Model 
{
    protected $table = 'exam_grade';
    
   


    public function quiz_attempt()
    {
        return $this->hasMany(Quiz_attempt::class,'id','quiz_attempt_id');
    }
}
