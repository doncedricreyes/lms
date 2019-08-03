<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\TeacherResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;




class Teacher extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'teacher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TeacherResetPasswordNotification($token));
    }
    
    public function class_subject_teachers()
    {
        return $this->belongsTo(Class_Subject_Teacher::class);
    }

    public function classes()
    {
        return $this->belongsTo(AddClass::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function teacher_profile(){
        return $this->hasOne(Teacher_Profile::class);
    }
}
