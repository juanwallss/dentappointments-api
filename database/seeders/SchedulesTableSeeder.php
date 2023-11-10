<?php

namespace Database\Seeders;

use App\Models\Schedules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SchedulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $startTime = Carbon::parse('10:00:00');
        $endTime = Carbon::parse('20:00:00');

        $interval = 30; // en minutos

        $currentTime = clone $startTime;

        while ($currentTime <= $endTime) {
            Schedules::create([
                'time' => $currentTime->format('H:i:s'),
            ]);

            $currentTime->addMinutes($interval);
        }
    }
}
