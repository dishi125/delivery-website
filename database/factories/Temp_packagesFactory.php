<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Temp_packages;
use Faker\Generator as Faker;

$factory->define(Temp_packages::class, function (Faker $faker) {

    return [
        'to_address_id' => $faker->randomDigitNotNull,
        'weight' => $faker->randomDigitNotNull,
        'packagekg' => $faker->word,
        'dimensionl' => $faker->randomDigitNotNull,
        'dimensionw' => $faker->randomDigitNotNull,
        'dimensionh' => $faker->randomDigitNotNull,
        'dimensions' => $faker->word,
        'dvalue' => $faker->randomDigitNotNull,
        'image' => $faker->word,
        'date' => $faker->word,
        'time' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
