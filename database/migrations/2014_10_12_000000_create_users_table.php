<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname')->unique()->comment('ローマ字の名前');
            $table->string('name')->comment('名前');
            $table->string('gender')->comment('性別 1:男性, 2:女性');
            $table->date('birthday')->nullable()->comment('誕生日');
            $table->string('introduction')->nullable()->comment('自己紹介文');
            $table->integer('role_id')->default(1)->comment('ユーザー権限');
            $table->string('image_path')->nullable()->comment('プロフィール画像');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
