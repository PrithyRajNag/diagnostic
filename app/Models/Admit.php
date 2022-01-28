<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admit extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'patient_id',
        'doctor_id',
        'package_id',
        'admission_date',
        'discharge_date',
        'guardian_name',
        'guardian_relation',
        'guardian_contact',
    ];
    protected $casts = [
        'address' => 'array',
    ];
}
