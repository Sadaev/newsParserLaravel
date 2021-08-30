<?php
namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseDto extends DataTransferObject implements Arrayable
{
}
