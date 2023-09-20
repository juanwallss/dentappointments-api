<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $specialties = array(
            'Odontopediata',
            'Odontologo General',
            'Ortodoncista'
        );

        foreach($specialties as $s) {
            Specialty::insert([
                'name' => $s
            ]);
        }
    }
}
