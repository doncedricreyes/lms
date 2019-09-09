<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    public $timestamps = false;

public function quiz_attempt(){
     
    return $this->hasMany(Quiz_Attempt::class,'id','quiz_attempt_id');
    
}
public function questions(){
     
    return $this->hasMany(Question::class,'id','question_id');
    
}

  
}
