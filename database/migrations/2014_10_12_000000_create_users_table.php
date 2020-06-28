<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('third_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('bio');
            $table->string('mobile_number');
            $table->date('dob');
            $table->string('image')->nullable();
            $table->integer('age');
            $table->string('address');
            $table->integer('gender');
            $table->integer('type'); //0 admin , 1 seller , 2 provider , 3 subworker
            $table->integer('status')->nullable();
            $table->integer('shop_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
