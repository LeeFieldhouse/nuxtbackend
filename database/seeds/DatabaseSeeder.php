<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Tweet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        factory(Tweet::class, 100)->create();
    }
}
