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
        Schema::create('categories_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('ingredients');
            $table->text('preparation');
            $table->string('image');
            $table->foreignId('user_id')->references('id')->on('users')->comment('The User who creates the recipe');
            $table->foreignId('category_id')->references('id')->on('categories_recipes')->comment('The Category of the recipe');
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
        Schema::dropIfExists('categories_recipes');
        Schema::dropIfExists('recipes');
    }
};
