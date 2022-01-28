<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestigationReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'patient_id',
        'date',
        'title',
        'description',
        'doctor_id',
        'image',
        'status',
    ];
}
