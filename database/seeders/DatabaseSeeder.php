<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 100 users, each with a random vote
        User::factory(100)->create()->each(function ($user) {
            Vote::factory(1)->create(['user_id' => $user->id]);
        });
    }
}
