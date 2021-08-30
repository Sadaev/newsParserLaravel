<?php
namespace App\Dto;

use App\Dto\BaseDto;

class RequestLogCreateDto extends BaseDto
{
    public string $request_method;

    public string $request_url;

    public string $response_http_code;

    public string $response_body;
}
