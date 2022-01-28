<?php

namespace App\Models;

use Askedio\Tests\App\Profiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Qualification extends Model
{
    use HasFactory;
    protected $guarded=[
        'id',
        'uuid',
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;
        });
    }
    public function profiles()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
