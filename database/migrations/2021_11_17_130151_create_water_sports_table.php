<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_sports', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('image');
            $table->text('deskripsi');
            $table->unsignedBigInteger('harga');
            $table->integer('minimal');
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
        Schema::dropIfExists('water_sports');
    }
}
