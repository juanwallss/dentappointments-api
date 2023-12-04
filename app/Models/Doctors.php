<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre', 
        'email', 
        'specialty_id', 
        'apellido_paterno', 
        'apellido_materno',
        'telefono',
        'hired',
    ];
    protected $table = 'doctores';

    public function especialidades() {
        return $this->belongsToMany(Specialty::class, 'doctor_especialidad', 'doctor_id')->withTimestamps();
    }
    public function citas () {
        return $this->hasMany(Appointments::class, 'paciente_id');
    }
}
