<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreLocaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_locale', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('locale_id');
            $table->boolean('default')->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('locale_id')->references('id')->on('locales');
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
        Schema::table('store_locale', function(Blueprint $table)
        {
            $table->dropForeign('store_id'); //
            $table->dropForeign('locale_id'); //
        });
        Schema::dropIfExists('store_locale');
    }
}
