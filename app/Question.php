<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{
    protected $table = 'questions';
    
   

  

    public function exams()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
        return $this->belongsTo(Answer::class);
    }
}
