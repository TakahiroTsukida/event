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
            $table->unsignedBigInteger('shop_id')->comment('開催店舗ID');
            $table->string('event_name')->comment('イベント名');
            $table->string('title')->nullable()->comment('イベントタイトル');
            $table->string('description')->nullable()->comment('イベントの概要');
            $table->string('conditions')->nullable()->comment('参加条件');
            $table->dateTime('start_time')->comment('イベント開始時間');
            $table->dateTime('end_time')->nullable()->comment('イベント終了時間');
            $table->dateTime('deadline')->nullable()->comment('イベント申込締切');
            $table->string('image_path')->nullable();
            $table->string('tax')->default(1)->comment('税抜・税込 1:税込 2:税抜');
            $table->timestamps();

            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
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
        Schema::dropIfExists('events');
    }
}
