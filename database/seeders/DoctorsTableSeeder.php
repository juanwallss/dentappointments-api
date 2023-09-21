<?php

namespace Database\Seeders;

use App\Models\Doctors;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {
            Doctors::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'father_lastname' => $faker->lastName,
                'mother_lastname' => $faker->lastName,
                'professional_id' => $faker->numberBetween(10000, 20000),
                'phone' => $faker->phoneNumber(),
                'hired' => $faker->boolean()
            ]);
        }
        $doctors = Doctors::all();
        foreach ($doctors as $d) {
            $d->specialties()->attach(Specialty::all()->random()->id);
        }
    }
}
