<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $guarded=[
        'id',
        'uuid'
    ];
    protected $softCascade = ['appointments'];


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
        return $this->belongsTo(Profile::class, 'doctor_id', 'id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id', 'schedule_id');
    }
}
