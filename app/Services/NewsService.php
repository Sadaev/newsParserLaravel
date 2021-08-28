<?php

use App\Models\NewsModel;

class NewsService
{
    public function create(NewsCreateDto $newsCreateDto){
        return NewsModel::query()->create($newsCreateDto->toArray());
    }
}
