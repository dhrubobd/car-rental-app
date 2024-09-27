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
                'email' => 'admin@admin.com',
                'password' => 'admin',
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

        DB::table('cars')->insert([
            [
                'name' => 'Axio',
                'brand' => 'Toyota',
                'model' => '2015',
                'year' => random_int(2010,2023),
                'car_type' => 'Sedan',
                'daily_rent_price' => '100',
                'availability' => true,
                'image' => 'uploads/car1.jpg',
            ],
            [
                'name' => 'BMW iX',
                'brand' => 'BMW',
                'model' => 'MY25-iX',
                'year' => random_int(2020,2023),
                'car_type' => 'SUV Electric',
                'daily_rent_price' => '200',
                'availability' => true,
                'image' => 'uploads/car2.jpg',
            ],
            [
                'name' => 'CH-R',
                'brand' => 'Toyota',
                'model' => '2018',
                'year' => random_int(2018,2023),
                'car_type' => 'SUV',
                'daily_rent_price' => '150',
                'availability' => true,
                'image' => 'uploads/car3.jpg',
            ],
            [
                
                'name' => 'Almera',
                'brand' => 'Nissan',
                'model' => '2022',
                'year' => random_int(2022,2024),
                'car_type' => 'Sedan',
                'daily_rent_price' => '120',
                'availability' => true,
                'image' => 'uploads/car4.jpg',
            ],
            [
                'name' => 'Model Y',
                'brand' => 'Tesla',
                'model' => '2023',
                'year' => random_int(2023,2024),
                'car_type' => 'Sedan Electric',
                'daily_rent_price' => '180',
                'availability' => true,
                'image' => 'uploads/car5.jpg',
            ],
        ]);
    }
}
