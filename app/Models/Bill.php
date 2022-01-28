<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'appointment_id',
        'patient_id',
        'total_service_charge',
        'advance_id',
        'payment_method',
        'card_cheque_no',
        'receipt_no',
        'total',
        'discount',
        'tax',
        'advance_payment',
        'payable',

    ];
}
