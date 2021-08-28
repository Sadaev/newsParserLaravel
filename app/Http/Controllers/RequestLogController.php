<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RequestLogService;

class RequestLogController extends Controller
{
    public function create($response, RequestLogService $requestLogService){
        $requestLogService->create($response);
    }
}
