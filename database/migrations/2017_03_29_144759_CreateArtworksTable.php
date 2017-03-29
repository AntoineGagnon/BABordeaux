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
            $table->string('born_died')->nullable();
            $table->string('title');
            $table->integer('date');
            $table->string('technique')->nullable();
            $table->string('location')->nullable();
            $table->string('image_url')->nullable();
            $table->string('type')->nullable();
            $table->string('form')->nullable();
            $table->string('school')->nullable();
            $table->string('timeframe')->nullable();
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
