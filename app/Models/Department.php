<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $guarded = [
        'id',
        'uuid',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
           $model->uuid = Str::uuid();
        });

    }
    protected $softCascade = ['profiles'];
    public function profiles()
    {
        return $this->hasMany(Profile::class,'department_id','id');
    }
}
