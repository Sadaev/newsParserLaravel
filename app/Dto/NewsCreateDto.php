<?php

use App\Dto\BaseDto;

class NewsCreateDto extends BaseDto
{
    public string $title;

    public string $link;

    public string $auth;

    public string $image;

    public DateTime $pubDate;

    public string $description;
}
