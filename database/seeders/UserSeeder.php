<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Arjuna Farm',
            'email' => 'admin@mail.com',
            'password' => bcrypt('arjunafarm'), // Use bcrypt for password hashing
        ]);
    }
}
