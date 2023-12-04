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
                'nombre' => $faker->name,
                'email' => $faker->email,
                'apellido_paterno' => $faker->lastName,
                'apellido_materno' => $faker->lastName,
                'ced_prof' => $faker->numberBetween(10000, 20000),
                'telefono' => $faker->phoneNumber(),
                'contratado' => $faker->boolean(),
                'genero' => $faker->randomElement(['H', 'M'])
            ]);
        }
        $doctores = Doctors::all();
        foreach ($doctores as $d) {
            $d->especialidades()->attach(Specialty::all()->random()->id);
        }
    }
}
