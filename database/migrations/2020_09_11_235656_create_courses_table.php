<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name', 100);
            $table->string('course_code', 10);
            $table->unsignedInteger('credit_unit');
            $table->integer('user_id')->index()->unsigned();
            $table->integer('level_id')->index()->unsigned();
            $table->integer('semesters')->default(false);
            $table->integer('choices')->default(false);;
            $table->timestamps();
            $table->integer('email_sent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
