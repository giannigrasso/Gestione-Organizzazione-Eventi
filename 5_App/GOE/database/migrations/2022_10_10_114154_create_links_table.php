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
        Schema::create('links', function (Blueprint $table) {
            $table->unsignedBigInteger('id_event');
            $table->foreign('id_event')->references('id')->on('events');

            $table->unsignedBigInteger('id_group');
            $table->foreign('id_group')->references('id')->on('groups');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            $table->primary(['id_event', 'id_group', 'id_user']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
};
