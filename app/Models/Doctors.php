<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'email', 
        'specialty_id', 
        'father_lastname', 
        'mother_lastname',
        'phone',
        'hired',
    ];

    public function specialties() {
        return $this->belongsToMany(Specialty::class, 'specialty_doctor', 'doctor_id')->withTimestamps();
    }
    public function appointments () {
        return $this->hasMany(Appointments::class, 'patient_id');
    }
}
