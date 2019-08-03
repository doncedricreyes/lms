<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddTeacher extends Model 
{
    protected $table = 'teachers';
    
     protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }
}
