<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AnalyticType;
use App\Property;
use Faker\Generator as Faker;

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

$factory->define(AnalyticType::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'units'   => $faker->word,
        'is_numeric' => $faker->boolean,
        'num_decimal_places' => $faker->numberBetween(0, 5),
    ];
});
