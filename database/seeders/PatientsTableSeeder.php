<?php

namespace Database\Seeders;

use App\Models\Patients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) { 
            Patients::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'father_lastname' => $faker->lastName,
                'mother_lastname' => $faker->lastName,
                'phone' => $faker->phoneNumber(),
                'street' => $faker->streetAddress(),
                'state' => $faker->state,
                'country' => $faker->country,
                'city' => $faker->city,
                'postal_code' => $faker->numberBetween(10000,99999)
            ]);
        }
    }
}
