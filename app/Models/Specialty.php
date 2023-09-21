<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function doctors() {
        return $this->belongsToMany(Doctors::class, 'specialty_doctor', 'specialty_id')->withTimestamps();
    }
}
