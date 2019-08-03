<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ParentResetPasswordNotification;

class Parents extends Authenticatable
{
    use Notifiable;
    public $primaryKey = 'id';
    protected $guard = 'parent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
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
        $this->notify(new ParentResetPasswordNotification($token));
    }

    public function Class_Student()
    {
        return $this->belongsTo(Class_Student::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
