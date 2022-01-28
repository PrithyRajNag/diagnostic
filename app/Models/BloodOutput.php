<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodOutput extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->first_name);
            $model->slug = $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->first_name);
            $model->slug = $slug;
        });

    }
}
