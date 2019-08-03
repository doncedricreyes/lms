<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Class_Student extends Model
{
    use Notifiable;
    protected $table = 'class_students';
    public $timestamps = false;

    protected $fillable=[
        'student_id','class_subject_teacher_id','parent_id','first','second','third','fourth','final',
    ];


    public function class_subject_teachers()
    {
        return $this->hasMany(Class_Subject_Teacher::class,'id','class_subject_teacher_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class,'id','student_id');
    }

    public function parents()
    {
        return $this->hasMany(Parent::class,'id','parent_id');
    }

  
}
