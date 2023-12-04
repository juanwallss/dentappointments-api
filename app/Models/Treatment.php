<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $table = 'tratamientos';
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion'
    ];

    public function citas () {
        return $this->hasMany(Appointments::class, 'paciente_id');
    }
}
