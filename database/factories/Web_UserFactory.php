<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Web_User;
use Faker\Generator as Faker;

$factory->define(Web_User::class, function (Faker $faker) {

    return [
        'fname' => $faker->word,
        'lname' => $faker->word,
        'email' => $faker->word,
        'mobile' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
