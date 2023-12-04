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
        $especialidades = array(
            'Odontopediata',
            'Odontologo General',
            'Ortodoncista',
            'Endodoncista',
            'Periodoncista',
            'Cirugano Maxilofacial'
        );

        foreach($especialidades as $s) {
            Specialty::insert([
                'nombre' => $s
            ]);
        }
    }
}
