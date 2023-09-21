<?php

namespace Database\Seeders;

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10; $i++) { 
            $date = $faker->date(); // Genera una fecha aleatoria (dia-mes-año)
            $initialTime = $faker->time('H:i'); // Genera una hora aleatoria (HH:MM)

            $initialTimeObject = \Carbon\Carbon::createFromFormat('H:i', $initialTime);
            $endTimeObject = $initialTimeObject->addMinutes(30);
            $endTime = $endTimeObject->format('H:i');

            $status = $faker->randomElement(['AGENDADA', 'CANCELADA', 'REALIZADA']); // Enum aleatorio

            Appointments::create([
                'date' => $date,
                'initial_time' => $initialTime,
                'end_time' => $endTime,
                'status' => $status,
                'patient_id' => Patients::all()->random()->id,
                'doctor_id' => Doctors::all()->random()->id
            ]);
        }
    }
}
