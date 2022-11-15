<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([

            'name' => 'Sa3eed',
            'email' => 'sa3eed@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$hQ8vsaeq92DwRzYN4NSNU.VM43oIOlKTaoerPtyX43kmwwYWGFBlC', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
