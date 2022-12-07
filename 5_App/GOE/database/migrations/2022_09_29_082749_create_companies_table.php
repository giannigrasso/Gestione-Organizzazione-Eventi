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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            $table->unsignedBigInteger('id_group1')->unique();
            $table->foreign('id_group1')->references('id')->on('groups');

            $table->unsignedBigInteger('id_group2')->unique();
            $table->foreign('id_group2')->references('id')->on('groups');

            $table->unsignedBigInteger('id_event');
            $table->foreign('id_event')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
