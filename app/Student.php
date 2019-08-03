<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\StudentResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;



class Student extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'student';
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
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
        $this->notify(new StudentResetPasswordNotification($token));
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function Class()
    {
        return $this->belongsTo('App\AddClass');
    }
    public function Class_Student()
    {
        return $this->belongsTo(Class_Student::class);
    }

    public function answers(){
        return $this->belongsTo(Answer::class);
    }

    public function exam_grades(){
        return $this->belongsTo(Exam_Grade::class);
    }

    public function student_assignment(){
        return $this->belongsTo(Student_Assignment::class);
    }

    public function grade_subjects(){
        return $this->belongsTo(Grade_Subject::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
