<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AddClass extends Model
{
    //
 
    protected $table = 'classes';
    public $timestamps = false;


    

   public function class_subject_teachers()
    {
        return $this->belongsTo(Class_Subject_Teacher::class);
    }

 

    public function teachers()
    {
        return $this->hasMany(Teacher::class,'id','adviser_id');
    }

    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
}

