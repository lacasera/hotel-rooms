<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Room;
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

$factory->define(Room::class, function (Faker $faker) {
    return [
        'code' => $faker->word(),
        'price' => $faker->randomFloat(10.0, 200.0),
        'hotel' => $faker->firstName(),
        'rating' => rand(1, 5),
        'advertiser' => collect([
            'advertiser_one', 
            'advertiser_two', 
            'advertiser_three'
        ])->random(),
        'currency' => 'EUR'
    ];
});
