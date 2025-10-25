<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {
        $plainPassword = 'rozan123';

        // Create or update the primary user to avoid duplicate seed errors
        User::updateOrCreate([
            'email' => 'rozan@gmail.com',
        ], [
            'name' => 'Rozan Aiman Ramadani',
            'username' => 'rozanaiman',
            'email_verified_at' => now(),
            'password' => Hash::make($plainPassword), // Use Hash facade to hash the password
            'remember_token' => Str::random(10),
        ]);

        // Create one additional random user if there is no other user
        if (User::count() < 2) {
            User::factory()->create();
        }
    }
}
