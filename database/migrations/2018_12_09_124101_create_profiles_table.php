<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
            $table->date('bday')->nullable();
            $table->integer('age')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('gender')->nullable();
            $table->string('Nationality')->nullable();
            $table->string('address')->nullable();
            $table->integer('phone_no')->nullable();
            $table->integer('cp_no')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_address')->nullable();
            $table->integer('father_phone_no')->nullable();
            $table->integer('father_cp_no')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_address')->nullable();
            $table->integer('mother_phone_no')->nullable();
            $table->integer('mother_cp_no')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_address')->nullable();
            $table->integer('guardian_phone_no')->nullable();
            $table->integer('guardian_cp_no')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('profile_pic')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
