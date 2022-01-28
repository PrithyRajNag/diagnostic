<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendEmail extends Model
{
    use HasFactory;
    protected $guarded=[
        'email_to',
        'receiver',
        'subject',
        'message',
        'file',
    ];
}
