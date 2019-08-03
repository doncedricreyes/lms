<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddSubject extends Model 
{
    protected $table = 'subjects';
    
     protected $fillable = [
        'title',
    ];

    public function Class_Subject_Teacher()
    {
        return $this->belongsTo('App\Class_Subject_Teacher');
    }

}
  

