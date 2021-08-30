<?php
namespace App\Dto;

use App\Dto\BaseDto;
use DateTime;


class NewsCreateDto extends BaseDto
{
    public string $title;

    public string $link;

    public string $author;

    public string $image;

    public DateTime $pubDate;

    public string $description;
}
