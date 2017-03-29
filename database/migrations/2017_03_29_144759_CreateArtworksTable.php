<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('artist');
            $table->string('born_died');
            $table->string('title');
            $table->string('date');
            $table->string('technique');
            $table->string('location');
            $table->string('image_url');
            $table->string('type');
            $table->string('form');
            $table->string('school');
            $table->string('timeframe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artworks');
    }
}
