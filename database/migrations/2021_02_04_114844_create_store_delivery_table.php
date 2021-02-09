<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_delivery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
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
        Schema::table('store_delivery', function(Blueprint $table)
        {
            $table->dropForeign('store_id'); //
            $table->dropForeign('delivery_id'); //
        });
        Schema::dropIfExists('store_delivery');
    }
}
