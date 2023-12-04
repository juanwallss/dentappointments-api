<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];
    protected $table = 'especialidades';

    public function doctores() {
        return $this->belongsToMany(Doctors::class, 'doctor_especialidad', 'specialty_id', 'doctor_id')->withTimestamps();
    }
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'paciente_id');
    }
}
