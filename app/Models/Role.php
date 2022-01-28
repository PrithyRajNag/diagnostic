<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $guarded =[
        'id',
        'uuid',
        'slug',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;

            $slug = Str::slug($model->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

//        static::updating(function($model) {
//            $slug = Str::slug($model->title);
//            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
//            $model->slug = $count ? "{$slug}-{$count}" : $slug;
//        });
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_assign_to_roles',
            'role_id','permission_id')->withPivot("role_id", "permission_id")->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'role_assign_to_user');
    }

}
