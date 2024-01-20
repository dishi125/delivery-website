<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Driver_review;
use Faker\Generator as Faker;

$factory->define(Driver_review::class, function (Faker $faker) {

    return [
        'driver_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'rate' => $faker->randomDigitNotNull,
        'comment' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
