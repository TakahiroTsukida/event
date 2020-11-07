<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('店舗名');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->string('postcode')->nullable()->comment('郵便番号');
            $table->string('pref_code')->nullable()->comment('都道府県');
            $table->string('city_code')->nullable()->comment('市区町村郡');
            $table->string('block')->nullable()->comment('住所: それ以降');
            $table->string('open')->nullable()->comment('開店時間');
            $table->string('close')->nullable()->comment('閉店時間');
            $table->string('web')->nullable()->comment('ホームページURL');
            $table->string('google_map_url')->nullable()->comment('googleMapのURL');
            $table->string('image_path')->nullable()->comment('店舗画像');
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
        Schema::dropIfExists('shops');
    }
}
