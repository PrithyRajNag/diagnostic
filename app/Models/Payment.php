<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Payment extends Model
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
        static::creating(function($model) {
            $model->uuid = Str::uuid();
        });

    }

    public function accounts()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    public function transactions()
    {
        return $this->belongsToMany(Account::class, 'transactions',
            'payment_id','account_id')->withPivot("payment_id", "account_id", "payment_date", "amount")->withTimestamps();
    }




}
