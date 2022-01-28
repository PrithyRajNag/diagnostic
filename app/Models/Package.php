<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Package extends Model
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
    protected $softCascade = ['patients'];
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_package',
            'package_id','service_id')->withPivot("package_id", "service_id")->withTimestamps();
    }
    public function patients()
    {
        return $this->hasMany(Patient::class,'package_id','id');
    }
}
