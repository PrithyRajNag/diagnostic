<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $guarded=[
        'id'
    ];
    protected $softCascade = ['testInvoices'];

    static public function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->uuid = Str::uuid();

            $rand = substr(uniqid(sha1(time())),0,10);
            $unique = preg_replace('/[^0-9\-]/', 0, $rand);
            $model->pid = $unique;
        });
    }
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function doctors()
    {
        return $this->belongsTo(Profile::class,'doctor_id', 'id' );
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function bedLists()
    {
        return $this->belongsToMany(BedList::class,'bed_assigns');
    }
    public function testInvoices()
    {
        return $this->hasMany(TestInvoice::class,'id', 'test_invoice_id');
    }
    public function histories()
    {
        return $this->belongsToMany(BedList::class, 'patient_histories',
            'patient_id','bed_list_id')->withPivot("patient_id", "bed_list_id", "category", "type","time","description","updated_by")->withTimestamps();
    }

}
