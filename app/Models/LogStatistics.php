<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'request_uri',
        'user_agent',
        'http_referer',
    ];

}
