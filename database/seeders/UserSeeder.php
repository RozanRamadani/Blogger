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
        User::factory()->create([
            'name' => 'Rozan Aiman Ramadani',
            'username' => 'rozanaiman',
            'email' => 'rozan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make($plainPassword), // Use Hash facade to hash the password
            'remember_token' => Str::random(10),
        ]);
        
        User::factory()->create();
    }
}
