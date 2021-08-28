<?php

use App\Models\RequestLogsModel;

class RequestLogService
{
    function create(RequestLogCreateDto $requestLogCreateDto){
        return RequestLogsModel::query()->create($requestLogCreateDto->toArray());
    }
}
