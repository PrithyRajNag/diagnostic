<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
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
    public function patients()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function doctors()
    {
        return $this->belongsTo(Profile::class, 'doctor_id', 'id');
    }
    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id','id' );
    }
}
