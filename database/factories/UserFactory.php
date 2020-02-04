<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
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

    $created_at = $faker->dateTimeBetween('this year', '+12 months');
    $updated_at = $faker->dateTimeBetween($created_at, '+12 months');

    return [
        'name' => $faker->unique()->name,
        'role_id' => $faker->numberBetween(2,4),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'password',
        'remember_token' => Str::random(10),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
