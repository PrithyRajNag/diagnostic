<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'appointment_id',
        'patient_id',
        'amount',
        'payment_method',
        'receipt_no',
        'status',

    ];

}
