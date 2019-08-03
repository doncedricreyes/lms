<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_student_id')->unsigned();
            $table->foreign('sender_student_id')->references('id')->on('students');
            $table->integer('sender_teacher_id')->unsigned();
            $table->foreign('sender_teacher_id')->references('id')->on('teachers');
            $table->integer('sender_admin_id')->unsigned();
            $table->foreign('sender_admin_id')->references('id')->on('admins');
            $table->integer('sender_parent_id')->unsigned();
            $table->foreign('sender_parent_id')->references('id')->on('parents');


            $table->integer('recipient_student_id')->unsigned();
            $table->foreign('recipient_student_id')->references('id')->on('students');
            $table->integer('recipient_teacher_id')->unsigned();
            $table->foreign('recipient_teacher_id')->references('id')->on('teachers');
            $table->integer('recipient_admin_id')->unsigned();
            $table->foreign('recipient_admin_id')->references('id')->on('admins');
            $table->integer('recipient_parent_id')->unsigned();
            $table->foreign('recipient_parent_id')->references('id')->on('parents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
