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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('gender')->nullable();
            /**$table->integer('id_group')->nullable();
            $table->foreign('id_group')->references('id')->on('groups');
            $table->unsignedBigInteger('id_event')->nullable();
            $table->foreign('id_event')->references('id_event')->on('groups');*/
            $table->string('name_type');
            $table->foreign('name_type')->references('name')->on('types');

            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
