<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Tweet;
use App\Like;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'testing',
            'password' => bcrypt('password'),
            'email' => 'testing@testing.com',
            'avatar' => 'https://getattention.co.uk/av/'. mt_rand(1, 9) . '.png',
        ]);
        factory(User::class, 10)->create();
        factory(Tweet::class, 50)->create();
        factory(Like::class, 100)->create();
        factory(Tag::class, 50)->create();
    }
}
