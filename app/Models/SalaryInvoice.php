<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SalaryInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [
        'id',
        'uuid',
    ];
    protected $casts = [
        'description' => 'array',
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

    public function profiles()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
    public function accounts()
    {
        return $this->hasOne(Account::class, 'id', 'salary_invoice_id');
    }

}
