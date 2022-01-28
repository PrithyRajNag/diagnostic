<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class   BedList extends Model
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
    public function bedTypes()
    {
        return $this->belongsTo(BedType::class, 'bed_type_id', 'id');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'bed_assigns',
            'bed_list_id','patient_id')->withPivot("patient_id", "bed_list_id")->withTimestamps();
    }
    public function histories()
    {
        return $this->belongsToMany(Patient::class,'patient_histories');
    }
}
