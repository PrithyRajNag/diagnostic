<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[
      'name',
      'category_id',
      'description',
      'price',
      'manufactured_by',
        'status',
    ];
}
