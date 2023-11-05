<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $table = 'treatments';
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function appointments () {
        return $this->hasMany(Appointments::class, 'patient_id');
    }
}
