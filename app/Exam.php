<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model 
{
    use Notifiable;
    protected $table = 'exams';
    protected $dates = [
        'date_start' => 'datetime:d/m/Y', // Change your format
        'date_end' => 'datetime:d/m/Y',
    ];
   

    public function class_subject_teachers()
    {
        return $this->belongsTo(Class_Subject_Teacher::class,'class_subject_teacher_id','id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

 

    public function quiz_attempt()
    {
        return $this->belongsTo(Quiz_Attempt::class);
    }
}
