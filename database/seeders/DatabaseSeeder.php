<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => "jeka",
            'email' => "Admin@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$G6Lo0X6pweXhtbstsM273OVtSEB/dh.qu00mP6Mqj36Uot4Wth37W', // password
        ]);
    }
}
