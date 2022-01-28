<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [
        'id',
        'uuid',
    ];
    protected $casts=[
        'details' => 'array',
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;

            $today = date("Ymd");
            $rand = strtoupper(substr(uniqid(sha1(time())),0,2));
            $unique = $today . $rand;
            $model->invoice_number = $unique;
        });
    }
    public function patients()
    {
        return $this->hasMany(Patient::class,'patient_id', 'id');
    }
    public function accounts()
    {
        return $this->hasOne(Account::class, 'id', 'test_invoice_id');
    }
    public function doctors()
    {
        return $this->belongsTo(profile::class, 'doctor_id', 'id');
    }
    public function doctorPercentages()
    {
        return $this->hasMany(DoctorPercentage::class, 'doctor_percentage_id', 'id');
    }

}
