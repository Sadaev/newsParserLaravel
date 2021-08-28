<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use ParserRssService;

class RssParserController extends Controller
{
    public string $rss_url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

    public function __constructor(){
    }

    /**
     * @throws GuzzleException
     */
    public function parser(ParserRssService $parserRssService)
    {
        $parserRssService->parseRssFeedByUrl($this->rss_url);
    }
}




