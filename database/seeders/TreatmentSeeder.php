<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    public function run()
    {
        $tratamientos = [
            [
                'nombre' => 'Limpieza Dental',
                'precio' => 100,
                'descripcion' => 'Limpieza profesional de dientes.',
            ],
            [
                'nombre' => 'Extracción de Muelas',
                'precio' => 200,
                'descripcion' => 'Extracción de muelas problemáticas.',
            ],
            [
                'nombre' => 'Blanqueamiento Dental',
                'precio' => 150,
                'descripcion' => 'Blanquear Dientes con productos de primera.',
            ],
            [
                'nombre' => 'Ortodoncia',
                'precio' => 3000,
                'descripcion' => 'Corrección de la alineación dental.',
            ],
            [
                'nombre' => 'Resina Dental',
                'precio' => 75,
                'descripcion' => 'Reparación de dientes con caries.',
            ],
        ];

        foreach ($tratamientos as $treatmentData) {
            Treatment::create($treatmentData);
        }
    }
}

