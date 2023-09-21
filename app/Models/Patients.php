<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'name',
        'father_lastname',
        'mother_lastname',
        'phone',
        'email',
        'street',
        'state',
        'city',
        'country',
        'postal_code',
        'date_of_birth',
        'gender'
    ];
}
