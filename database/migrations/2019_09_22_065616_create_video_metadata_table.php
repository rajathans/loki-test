<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_metadata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('video_id')->unique();
            $table->unsignedInteger('size');
            $table->unsignedInteger('viewers')->default(0);
            $table->timestamps();

            // $table->foreign('video_id')->references('id')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_metadata');
    }
}
