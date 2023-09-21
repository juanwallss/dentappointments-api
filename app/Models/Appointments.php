<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected  $fillable = [
        'date',
        'initial_time',
        'end_time',
        'status',
        'patient_id',
        'doctor_id'
    ];
}
