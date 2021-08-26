<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLogs extends Model
{
    use HasFactory;

    protected $fillable = ['created_at', 'request_method', 'request_url', 'response_http_code', 'response_body'];
}
