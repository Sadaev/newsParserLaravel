<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLogsModel extends Model
{
    use HasFactory;

    protected $table = "requestlog";
    protected $fillable = ['created_at', 'request_method', 'request_url', 'response_http_code', 'response_body'];
}
