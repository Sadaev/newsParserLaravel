<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RequestLogService;

class RequestLogController extends Controller
{
//    private static RequestLogService $requestLogService;
//
//    public function __construct(RequestLogService $requestLogService){
//        self::$requestLogService = $requestLogService;
//    }

    public static function create($response, RequestLogService $requestLogService){
        return $requestLogService->create($response);
    }
}
