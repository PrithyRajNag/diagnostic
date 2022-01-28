<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
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
    public function roles()
    {
        return $this->belongsToMany(Role::class,'permission_assign_to_roles');
    }
}
