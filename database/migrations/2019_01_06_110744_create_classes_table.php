<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
 
      public function up()
    {
         Schema::create('classes', function (Blueprint $table) {
             $table->string('year_and_section')->primary();
           $table->string('section_name');
           $table->integer('adviser_id')->unsigned();
           $table->foreign('adviser_id')->references('id')->on('teachers');
           $table->integer('subject_id')->unsigned();
           $table->foreign('subject_id')->references('id')->on('subjects');
           $table->integer('teacher_id')->unsigned();
           $table->foreign('teacher_id')->references('id')->on('teachers');
           $table->string('day');
           $table->string('time_start');
           $table->string('time_end');
     
        });
    }

   
    public function down()
    {
         Schema::dropIfExists('classes');
    }
}
