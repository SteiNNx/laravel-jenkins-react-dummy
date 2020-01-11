<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Models Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Usuarios::class, function (Faker $faker) {
    return [
        'nombre'       => $faker->name,
        'password' => '1234',
		'api_token'      => Str::random( 10 ),
		'remember_token' => Str::random( 10 ),
    ];
});
