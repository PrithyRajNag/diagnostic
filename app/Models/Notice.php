<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Notice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
        'id',
    ];
    static public function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });
    }
}
