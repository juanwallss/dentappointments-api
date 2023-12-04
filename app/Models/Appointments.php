<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $table = 'citas';
    protected  $fillable = [
        'date',
        'initial_time_id',
        'end_time_id',
        'status',
        'paciente_id',
        'doctor_id'
    ];

    public function patient() {
        return $this->belongsTo(Patients::class, "paciente_id");
    }
    public function tratamientos() {
        return $this->belongsTo(Treatment::class, "treatment_id");
    }
    public function doctor() {
        return $this->belongsTo(Doctors::class, "doctor_id");
    }
    public function initialTime()
    {
        return $this->belongsTo(Schedule::class, 'initial_time_id');
    }
    public function endTime()
    {
        return $this->belongsTo(Schedule::class, 'end_time_id');
    }
}
