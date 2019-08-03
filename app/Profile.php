<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    public $timestamps = false;
    public function students()
    {
        return $this->belongsTo('App\Student');
    }
    public function age() {
        return $this->dob->diffInYears(\Carbon::now());
    }
    protected $fillable = [
        'student_id','bday','birthplace','gender','Nationality','address','phone_no','cp_no','father_name','father_address','father_phone_no','father_cp_no','father_email','father_occupation','father_name','father_address','father_phone_no','father_cp_no','father_email','father_occupation','mother_name','mother_address','mother_phone_no','mother_cp_no','mother_email','mother_occupation','guardian_name','guardian_address','guardian_phone_no','guardian_cp_no','guardian_email','guardian_occupation','profile_pic','bio'
    ];
}
