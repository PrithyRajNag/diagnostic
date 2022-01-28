<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lab extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $guarded=[
        'id',
        'uuid',
    ];
    protected $softCascade = ['testCategories'];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model) {
           $model->uuid = Str::uuid();
        });
    }
    public function testCategories()
    {
        return $this->hasMany(TestCategory::class);
    }
}
