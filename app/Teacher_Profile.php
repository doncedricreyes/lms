<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Teacher_Profile extends Model
{
    protected $table = 'teacher_profile';
    public $timestamps = false;
    public function teachers()
    {
        return $this->belongsTo('App\Teacher','teacher_id','id');
    }
    public function age() {
        return $this->dob->diffInYears(\Carbon::now());
    }
    protected $fillable = [
        'teacher_id','bday','birthplace','gender','address','phone_no','cp_no','highschool','college'    ];
}
