<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Province;
use Faker\Generator as Faker;

$factory->define(Province::class, function (Faker $faker) {

    return [
        'country_name' => $faker->word,
        'name' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
