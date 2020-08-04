<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('shop_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('title')->nullable();
            $table->string('descripsion')->nullable();
            $table->string('image_path')->nullable();
            $table->string('conditions')->nullable();
            $table->string('finish')->default(0);
            $table->string('tax')->default(0);
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
        Schema::dropIfExists('events');
    }
}