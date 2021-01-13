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
            $table->id();
            $table->string('product_name', 255);
            $table->integer('rating')->nullable();
            $table->float('price');
            $table->string('logo_image', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('short_description', 500)->nullable();
            $table->string('full_description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
