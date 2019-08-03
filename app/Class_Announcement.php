<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_Announcement extends Model
{
    protected $table = 'class_announcements';
    


public function classes(){
     
    return $this->belongsTo(AddClass::class);
    
}


  
}
