<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {

    return [
        'payment_id' => $faker->randomDigitNotNull,
        'payer_id' => $faker->randomDigitNotNull,
        'amount' => $faker->randomDigitNotNull,
        'description' => $faker->word,
        'invoice' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
