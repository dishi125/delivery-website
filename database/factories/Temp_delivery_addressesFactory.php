<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Temp_delivery_addresses;
use Faker\Generator as Faker;

$factory->define(Temp_delivery_addresses::class, function (Faker $faker) {

    return [
        'parent_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'to_form' => $faker->word,
        'name' => $faker->word,
        'company_id' => $faker->randomDigitNotNull,
        'country_id' => $faker->randomDigitNotNull,
        'street_add' => $faker->word,
        'street_add1' => $faker->word,
        'mobile' => $faker->word,
        'mobile1' => $faker->word,
        'email' => $faker->word,
        'sms_verification' => $faker->word,
        'price' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
