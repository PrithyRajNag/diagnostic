<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PatientBillingInvoice extends Model
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
    public function services()
    {
        return $this->belongsToMany(Service::class, 'patient_services',
            'patient_id','service_id')->withPivot("patient_id", "service_id", "service_date", "count","amount","updated_by")->withTimestamps();
    }
    public function accounts()
    {
        return $this->hasOne(Account::class, 'id', 'patient_billing_invoice_id');
    }
}
