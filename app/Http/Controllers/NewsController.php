<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\NewsModel;

class NewsController extends Controller
{
    public function create($news, NewsService $newsService){
        $newsService->create($news);
    }
}
