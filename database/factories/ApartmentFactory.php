<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Properties;
use App\Models\Owner;
use Faker\Generator as Faker;

$factory->define(Properties::class, function (Faker $faker) {
    return [
        'owner_id'    => Owner::inRandomOrder()->first()->id,
        'type'        => '0',
        'price'       => $faker->randomNumber(),
        'size'        => $faker->randomDigit,
        'room_number' => $faker->randomDigit,
        'bathrooms'   => $faker->randomDigit,
        'address'     => $faker->text(100),
        'description' => $faker->paragraph,
        'images'      => $faker->imageUrl(),
        'garage'      => '1',
        'furniture'   => '0',
        'famous'      => rand(0,1),
        'show'        => rand(0,1),
        'rating'      => '4',
        'status'      => '0',
    ];
});
