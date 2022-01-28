<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $guarded=[
        'id',
        'uuid',
    ];
    protected $softCascade = ['reportTemplates'];
    public static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->uuid = Str::uuid();
        });
    }
    public function testCategories()
    {
        return $this->belongsTo(TestCategory::class, 'category_id', 'id');
    }
    public function reportTemplates()
    {
        return $this->hasOne(TestReportTemplate::class, 'id', 'test_item_id');
    }
    public function testReports()
    {
        return $this->hasMany(TestReport::class, 'id', 'test_item_id');
    }
}
