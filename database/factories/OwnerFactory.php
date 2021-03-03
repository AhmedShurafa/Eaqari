<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Owner;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


$factory->define(Owner::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'phone' => $faker->phoneNumber,
        'phone2' => $faker->phoneNumber,
        'ssn' => $faker->randomNumber(9),
        'evaluate' => $faker->numberBetween(0,5),
        'image' => $faker->imageUrl(),
        'facebook' => $faker->word,
        'twitter' => $faker->word,
        'instagram' => $faker->word,
        'status' => $faker->boolean(50),
    ];
});
