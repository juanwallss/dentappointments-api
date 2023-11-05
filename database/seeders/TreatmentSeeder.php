<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    public function run()
    {
        $treatments = [
            [
                'name' => 'Limpieza Dental',
                'price' => 100,
                'description' => 'Limpieza profesional de dientes.',
            ],
            [
                'name' => 'Extracción de Muelas',
                'price' => 200,
                'description' => 'Extracción de muelas problemáticas.',
            ],
            [
                'name' => 'Blanqueamiento Dental',
                'price' => 150,
                'description' => 'Blanquear Dientes con productos de primera.',
            ],
            [
                'name' => 'Ortodoncia',
                'price' => 3000,
                'description' => 'Corrección de la alineación dental.',
            ],
            [
                'name' => 'Resina Dental',
                'price' => 75,
                'description' => 'Reparación de dientes con caries.',
            ],
        ];

        foreach ($treatments as $treatmentData) {
            Treatment::create($treatmentData);
        }
    }
}

