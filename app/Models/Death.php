<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Death extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'receiver_contact',
        'date',
        'time',
        'phone_number',
        'note',
        'status',
        'patient_id',
        'doctor_id',
    ];
}
