<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Apartment;
use App\Models\Owner;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {
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
        'rating'      => '4',
        'status'      => '0',
    ];
});
