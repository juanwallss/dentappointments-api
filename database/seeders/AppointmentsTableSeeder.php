<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\Patients;
use App\Models\Schedules;
use App\Models\Treatment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtén todos los registros de la tabla Schedule
        $horas = Schedules::take(15)->get();

        for ($i = 0; $i < 40; $i++) {
            // Selecciona aleatoriamente un registro de la tabla Schedule
            $initialSchedule = $horas->random();

            // Asegúrate de que el endSchedule sea un ID válido y no supere la cantidad total de registros
            $endScheduleId = $initialSchedule->id + random_int(1, 3);
            if ($endScheduleId > $horas->count()) {
                $endScheduleId = $horas->count();
            }

            $endSchedule = $horas->where('id', $endScheduleId)->first();

            // Selecciona aleatoriamente un doctor
            $doctor = Doctors::all()->random();

            // Verifica si el doctor ya tiene una cita en el mismo rango de tiempo
            $existingAppointment = Appointments::where('doctor_id', $doctor->id)
                ->where(function ($query) use ($initialSchedule, $endSchedule) {
                    $query->whereBetween('initial_time_id', [$initialSchedule->id, $endSchedule->id])
                        ->orWhereBetween('end_time_id', [$initialSchedule->id, $endSchedule->id]);
                })
                ->exists();

            // Si el doctor ya tiene una cita en ese tiempo, omite esta iteración
            if ($existingAppointment) {
                continue;
            }

            // Asigna la relación a la tabla Appointments
            $appointment = Appointments::create([
                'date' => $faker->dateTimeBetween('+2 days', '+20 days')->format('Y-m-d'),
                'status' => $faker->randomElement(['AGENDADA', 'CANCELADA']),
                'paciente_id' => Patients::all()->random()->id,
                'doctor_id' => $doctor->id,
                'initial_time_id' => $initialSchedule->id,
                'end_time_id' => $endSchedule->id,
            ]);

            for ($i=0; $i < 2; $i++) { 
                DB::table('cita_tratamiento')->insert([
                    'cita_id' => $appointment->id,
                    'tratamiento_id' => Treatment::all()->random()->id
                ]);
            }
        }
    }
}
