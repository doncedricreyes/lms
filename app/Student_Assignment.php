<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Assignment extends Model 
{
    protected $table = 'student_assignment';
    
   

    public function students()
    {
        return $this->hasMany(Student::class,'id','student_id');
    }

    public function assignments()
    {
        return $this->belongsTo(Assignment::class,'assignment_id','id');
    }

}
