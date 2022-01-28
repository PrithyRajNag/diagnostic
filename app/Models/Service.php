<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
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
    public function packages()
    {
        return $this->belongsToMany(Package::class,'service_package');
    }
    public function patients()
    {
        return $this->belongsToMany(Patient::class,'patient_services');
    }
}
