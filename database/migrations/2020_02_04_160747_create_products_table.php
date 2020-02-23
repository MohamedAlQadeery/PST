<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode')->nullable()->unique();
            $table->string('name');
            $table->string('image');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->double('price_to_sell');
            $table->double('price_to_buy');
            $table->integer('quantity');
            $table->integer('status')->default(1);
            $table->integer('view_count')->default(0);
            $table->integer('sell_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
