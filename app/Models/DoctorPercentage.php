<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DoctorPercentage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [
        'id',
        'uuid'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;
        });
    }
    public function doctors()
    {
        return $this->belongsTo(Profile::class,'doctor_id', 'id' );
    }
    public function testInvoices()
    {
        return $this->hasMany(TestInvoice::class, 'id', 'doctor_percentage_id');
    }
    public function doctorEarningFromTests()
    {
        return $this->hasMany(DoctorEarningFromTest::class, 'id', 'doctor_percentage_id');
    }

}
