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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('breed');
            $table->unsignedInteger('age');
            $table->unsignedBigInteger('gender');
            $table->string('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('type')->references('id')->on('pet_types');
            $table->foreign('breed')->references('id')->on('pet_breeds');
            $table->foreign('gender')->references('id')->on('genders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};
