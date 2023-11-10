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
        'initial_time_id',
        'end_time_id',
        'status',
        'patient_id',
        'doctor_id'
    ];

    public function patient() {
        return $this->belongsTo(Patients::class, "patient_id");
    }
    public function treatments() {
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
