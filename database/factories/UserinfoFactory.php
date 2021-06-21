<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Userinfo;
use Faker\Generator as Faker;

$factory->define(Userinfo::class, function (Faker $faker) {
    return [
        'user_id'   =>User::all()->random()->id,
        'phone'     =>$faker->phoneNumber,
        'phone2'    =>$faker->phoneNumber,
        'ssn'       =>$faker->numberBetween(25, 45),
        'rating'    =>$faker->numberBetween(0, 5),
        'avatar'    =>$faker->randomeElement([
            "male","female"
        ])
    ];
});
