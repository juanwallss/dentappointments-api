<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $table = 'pacientes';
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'calle',
        'estado',
        'ciudad',
        'pais',
        'postal_code',
        'fecha_nac',
        'genero'
    ];

    public function citas () {
        return $this->hasMany(Appointments::class, 'paciente_id');
    }
}
