<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    $FN_1 = Array("山","川","谷","田","小","石","水","大","橋","野","池","吉","中");
    $FN_2 = Array("田","本","川","口","野","村","崎","山","島","上","浦","内","原");
    $LN_1 = Array("順","優","恵","浩","裕","正","昭","真","純","清","博","孝","幸");
    $LN_2 = Array("","一","二","子","美","一郎","実","義","夫","雄","太郎","彦");

    $roleIds = [1, 11, 21, 31, 41, 51];
    $genders = [1,2];

    $date = $faker->datetime($max = 'now', $timezone = date_default_timezone_get());

    return [
        'nickname'          => $faker->unique()->name,
        'name'              => $faker->randomElement($FN_1).$faker->randomElement($FN_2)
                                .$faker->randomElement($LN_1).$faker->randomElement($LN_2),
        'gender'            => $faker->randomElement($genders),
        'birthday'          => $date,
        'introduction'      => $faker->realText(50),
        'role_id'           => $faker->randomElement($roleIds),
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => $date,
        'password'          => Hash::make('1234'), // password
        'remember_token'    => Str::random(10),
    ];
});
