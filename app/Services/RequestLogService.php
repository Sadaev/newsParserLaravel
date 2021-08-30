<?php
namespace App\Services;

use App\Models\RequestLogsModel;
use App\Dto\RequestLogCreateDto;

class RequestLogService
{
    function create(RequestLogCreateDto $requestLogCreateDto){
        return RequestLogsModel::query()->create($requestLogCreateDto->toArray());
    }
}
