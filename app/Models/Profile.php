<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $guarded = [
        'id',
        'uuid',
    ];
    protected $casts = [
        'present_address' => 'array',
        'permanent_address' => 'array'
    ];

    static public function boot()
    {
        parent::boot();
        static::creating(function ($model){
           $model->uuid = Str::uuid();
        });
    }

    protected $softCascade = ['patients', 'schedules','salaryInvoices', 'educations', 'qualifications'];


    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'id' , 'doctor_id');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id', 'doctor_id');
    }
    public function salaryInvoices()
    {
        return $this->hasOne(SalaryInvoice::class, 'id', 'profile_id');
    }
    public function educations()
    {
        return $this->hasOne(Education::class, 'id', 'profile_id');
    }
    public function qualifications()
    {
        return $this->hasOne(Qualification::class, 'id', 'profile_id');
    }
    public function doctorPercentages()
    {
        return $this->hasOne(DoctorPercentage::class, 'id', 'doctor_id');
    }
    public function testInvoices()
    {
        return $this->hasMany(TestInvoice::class, 'id', 'doctor_id');
    }

}
