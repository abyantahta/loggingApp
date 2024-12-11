<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'user_in',
        'user_out',
        'duration',
    ];
    /** @use HasFactory<\Database\Factories\LogFactory> */
    use HasFactory;
}
