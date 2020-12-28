<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('name');
            $table->integer('level_id')->index()->unsigned()->nullable();;
            $table->Date('dateofbirth')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->Integer('housenumber')->nullable();
            $table->Date('yearofadmission')->nullable();
            $table->Date('yearofgrad')->nullable();
            $table->string('matnumber')->unique()->nullable();
            $table->integer('semesters')->default(false);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->integer('role_id')->index()->unsigned()->nullable()->default(3);
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
