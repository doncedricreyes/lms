<?php



use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeacherClassSubjectTable extends Migration
{
 
      public function up()
    {
         Schema::table('classes', function (Blueprint $table) {
           
           $table->integer('teacher_id')->unsigned()->nullable();
           $table->foreign('teacher_id')->references('id')->on('teachers');

        });
    }

    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            //
        });
    }
}