<?php

use Faker\Generator as Faker;
use App\Tweet;
use App\User;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        'tweet_id' => mt_rand(1, Tweet::all()->count()),
        'user_id' => mt_rand(1, User::all()->count())
    ];
});
