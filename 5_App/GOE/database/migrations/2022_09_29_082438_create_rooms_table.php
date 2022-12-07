<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->integer('number');
            $table->integer('capacity');
            $table->boolean('wifi');
            $table->boolean('smoking_area');
            $table->boolean('animals');

            $table->unsignedBigInteger('id_hotel');
            $table->foreign('id_hotel')->references('id')->on('hotels');
            $table->primary(['number', 'id_hotel']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
