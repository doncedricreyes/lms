<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation_Question extends Model 
{
    protected $table = 'evaluation_questions';
    
     protected $fillable = [
        'category',
        'question'
    ];



}
  

