<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->integer('shop_id');
            $table->integer('provider_id');
            $table->double('total');
            $table->integer('type'); //  1 normal , 2 debit
            $table->integer('status'); // 0 not delevired , 1 delivierd
            $table->integer('is_paid')->default(0); // 0 not paid , 1 paid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
