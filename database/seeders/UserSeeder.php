<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        \App\Models\User::factory()->create([
            'name' => 'Arjuna Farm',
            'email' => 'admin@mail.com',
            'password' => bcrypt('arjunafarm'), // Use bcrypt for password hashing
        ]);
    }
}
