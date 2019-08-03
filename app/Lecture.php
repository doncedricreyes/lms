<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use Notifiable;
    protected $table = 'lectures';
    
    public function class_subject_teachers()
    {
        return $this->belongsTo(Class_Subject_Teacher::class);
    }
}
