<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DoctorEarningFromTest extends Model
{
    use HasFactory;
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
    public function doctorPercentages()
    {
        return $this->belongsTo(DoctorPercentage::class, 'doctor_percentage_id', 'id');
    }

}
