<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $guarded=[
        'id',
        'uuid',
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;
        });
    }
    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'transactions');
    }
    public function test_invoices()
    {
        return $this->hasOne(TestInvoice::class,'test_invoice_id', 'id');
    }
    public function salaries()
    {
        return $this->hasOne(SalaryInvoice::class, 'salary_invoice_id', 'id');
    }
    public function billings()
    {
        return $this->hasOne(PatientBillingInvoice::class,'patient_billing_invoice_id', 'id');
    }

}
