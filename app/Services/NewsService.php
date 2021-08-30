<?php
namespace App\Services;

use App\Models\NewsModel;
use App\Dto\NewsCreateDto;

class NewsService
{
    public function create(NewsCreateDto $newsCreateDto){
        return NewsModel::query()->create($newsCreateDto->toArray());
    }
}
