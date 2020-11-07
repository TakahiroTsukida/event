<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('市区町村名');
            $table->unsignedBigInteger('prefecture_id')->comment('都道府県ID');
            $table->integer('order')->comment('表示順');
            $table->string('dummy')->comment('INSERT文が直せなかったダミー');
            $table->timestamps();

            $table->foreign('prefecture_id')
                ->references('id')
                ->on('prefectures')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
