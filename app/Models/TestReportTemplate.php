<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestReportTemplate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[
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
    public function testItems()
    {
        return $this->hasOne(TestItem::class, 'id', 'test_item_id');
    }

}
