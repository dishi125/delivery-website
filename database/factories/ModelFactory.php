<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {

    return [
        'carMakeId' => $faker->word,
        'name' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
