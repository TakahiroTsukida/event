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

    $genders = [1,2];
    return [
        'name'              => $faker->name,
        'gender'            => $faker->randomElement($genders),
        'birthday'          => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        'introduction'      => $faker->realText(50),
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => Hash::make('1234'), // password
        'remember_token'    => Str::random(10),
    ];
});
