<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class TestCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $guarded=[
        'id',
        'uuid',
    ];
    protected $softCascade = ['testItems'];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->uuid = Str::uuid();
        });

        static::addGlobalScope('sort', function ($builder) {
            $builder->orderBy('title');
        });
    }
    public function labs()
    {
        return $this->belongsTo(Lab::class, 'lab_id', 'id');
    }
    public function testItems()
    {
        return $this->hasMany(TestItem::class, 'id', 'category_id');
    }

}
