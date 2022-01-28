<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Ambulance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'id',
        'uuid',
    ];
    protected $casts=[
        'present_address' => 'array',
        'permanent_address' => 'array'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;
        });
    }

}
