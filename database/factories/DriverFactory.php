<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {

    return [
        'fname' => $faker->word,
        'lname' => $faker->word,
        'email' => $faker->word,
        'mobile' => $faker->word,
        'address' => $faker->text,
        'car_make' => $faker->word,
        'car_model' => $faker->word,
        'car_image' => $faker->text,
        'password' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
