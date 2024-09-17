<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            [
                'name' => 'Harry Potter',
                'email' => Str::random(10).'@example.com',
                'password' => Str::random(7),
                'phone' => random_int(1000000000,9999999999),
                'address' => fake()->sentence(10),
                'role' => 'admin',
            ],
            [
                'name' => 'Hasnat Abdullah',
                'email' => Str::random(10).'@example.com',
                'password' => Str::random(7),
                'phone' => random_int(1000000000,9999999999),
                'address' => fake()->sentence(10),
                'role' => 'customer',
            ],
            [
                'name' => 'Dipty Chowdhruy',
                'email' => Str::random(10).'@example.com',
                'password' => Str::random(7),
                'phone' => random_int(1000000000,9999999999),
                'address' => fake()->sentence(10),
                'role' => 'customer',
            ],
            [
                'name' => 'Sarjis Alom',
                'email' => Str::random(10).'@example.com',
                'password' => Str::random(7),
                'phone' => random_int(1000000000,9999999999),
                'address' => fake()->sentence(10),
                'role' => 'customer',
            ],
            [
                'name' => 'Sadia Sraboni',
                'email' => Str::random(10).'@example.com',
                'password' => Str::random(7),
                'phone' => random_int(1000000000,9999999999),
                'address' => fake()->sentence(10),
                'role' => 'customer',
            ],
        ]);
    }
}
