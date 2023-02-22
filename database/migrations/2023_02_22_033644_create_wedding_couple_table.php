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
        Schema::create('wedding_couple', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('instagram');
            $table->string('bio');
            $table->string('email')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('parent_name')->nullable();
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
        Schema::dropIfExists('wedding_couple');
    }
};
