<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CarModel;
use Faker\Generator as Faker;

$factory->define(CarModel::class, function (Faker $faker) {

    return [
        'car_make_name' => $faker->word,
        'name' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
