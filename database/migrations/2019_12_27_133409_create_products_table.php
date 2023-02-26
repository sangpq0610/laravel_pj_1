<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('origin_price');
            $table->integer('sale_price');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            
            $table->integer('amount')->default('0');
            $table->integer('rate')->default('5');
            $table->integer('rate_count')->default('1');
            $table->integer('sold')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
