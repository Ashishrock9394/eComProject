<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Ashish',
            'email' => 'admin@gmail.com',
            'user_type' => 1,
            'phone' => "9198552556",
            'address' => "delhi",
            'password' => Hash::make('00000000'), // Encrypt the password
        ]);
        User::create([
            'name' => 'Pooja',
            'email' => 'user@gmail.com',
            'user_type' => 0,
            'phone' => "9198552556",
            'address' => "delhi",
            'password' => Hash::make('00000000'), // Encrypt the password
        ]);
    }
}
