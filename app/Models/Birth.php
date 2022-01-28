<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Birth extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'status',
        'name',
        'mother_name',
        'father_name',
        'phone_number',
        'weight',
        'gender',
        'date',
        'time',
        'note',
        'blood_group',
        'doctor_id',
    ];
    protected $casts=[
        'address'=> 'array',
    ];
}
