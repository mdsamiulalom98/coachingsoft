<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 2000; $i++) {
            User::create([
                'name' => $faker->name,
                'image' => $faker->imageUrl(200, 200, 'people'), // Random image
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Default password
                'remember_token' => \Str::random(10),
                'status' => $faker->numberBetween(0, 1), // Random 0 or 1
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
