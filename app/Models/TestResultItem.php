<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestResultItem extends Model
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
    public function resultCategories()
    {
        return $this->belongsTo(TestResultCategory::class, 'result_category_id', 'id');
    }
}
