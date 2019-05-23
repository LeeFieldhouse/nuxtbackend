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
            'email' => 'testing@testing.com'
        ]);
        factory(User::class, 5)->create();
        factory(Tweet::class, 20)->create();
        factory(Like::class, 10)->create();
        factory(Tag::class, 10)->create();
    }
}
