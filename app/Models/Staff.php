<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'first_name',
        'last_name',
        'phone_number',
        'role',
        'email',
        'password',
        'gender',
        'image',
    ];

    protected $casts=[
        'present_address'=> 'array',
        'permanent_address' => 'array'
    ];

}
