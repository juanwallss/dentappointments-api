<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtyDoctors extends Model
{
    use HasFactory;
    protected $table = 'specialty_doctor';
    protected $fillable = [
        'specialty_id',
        'doctor_id'
    ];
}
