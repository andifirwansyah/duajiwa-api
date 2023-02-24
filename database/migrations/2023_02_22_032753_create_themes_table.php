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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('creators');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('theme_categories');
            $table->string('table_name')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('thumbnail');
            $table->string('design_capture');
            $table->integer('cost')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('is_premium')->default(true);
            $table->string('demo_url');
            $table->string('path');
            $table->string('tags')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('show_author_name')->default(false);
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
        Schema::dropIfExists('themes');
    }
};
