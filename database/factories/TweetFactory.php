<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Tweet::class, function (Faker $faker) {

    return [
        'tweet' => $faker->sentence,
        'user_id' => mt_rand(1, User::all()->count()),
    ];
});
