<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
 
      public function up()
    {
         Schema::create('classes', function (Blueprint $table) {
             $table->increments('id');
           $table->string('year');
           $table->string('section');
           $table->integer('subject_id')->unsigned();
           $table->foreign('subject_id')->references('id')->on('subjects');
           $table->integer('teacher_id')->unsigned();
           $table->foreign('teacher_id')->references('id')->on('teachers');
           $table->integer('adviser_id')->unsigned();
           $table->foreign('adviser_id')->references('id')->on('teachers');
           $table->string('day');
           $table->string('time_start');
           $table->string('time_end');
           $table->integer('student_id')->nullable()->unsigned();
           $table->foreign('student_id')->references('id')->on('students');
        });
    }

   
    public function down()
    {
         Schema::dropIfExists('classes');
    }
}
