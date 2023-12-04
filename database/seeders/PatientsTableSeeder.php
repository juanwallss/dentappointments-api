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
        for ($i=0; $i < 20; $i++) { 
            Patients::create([
                'nombre' => $faker->name,
                'email' => $faker->email,
                'apellido_paterno' => $faker->lastName,
                'apellido_materno' => $faker->lastName,
                'telefono' => $faker->phoneNumber(),
                'calle' => $faker->streetAddress(),
                'estado' => $faker->state,
                'pais' => $faker->country,
                'fecha_nac' => $faker->date(),
                'ciudad' => $faker->city,
                'genero' => $faker->randomElement(['H', 'M']),
                'postal_code' => $faker->numberBetween(10000,99999)
            ]);
        }
    }
}
