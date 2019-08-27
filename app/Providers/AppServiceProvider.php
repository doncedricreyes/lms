<?php

namespace App\Providers;
use Auth;
use App\Profile;
use App\Teacher_Profile;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
         
        view()->composer('layouts.user', function ($view) {
            $profiles = Profile::with('students')->where('student_id','=',Auth::user()->id)->get();
            $view->profiles = $profiles;
            $teacher_profiles = Teacher_Profile::with('teachers')->where('teacher_id','=',Auth::user()->id)->get();
            $view->teacher_profiles = $teacher_profiles;
       
        });


    Schema::defaultStringLength(191);

  ;
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
