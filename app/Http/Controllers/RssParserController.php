<?php

namespace App\Http\Controllers;

use App\Jobs\ParseRSS;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use App\Services\ParserRssService;

class RssParserController extends Controller
{
//    protected $parserRssService;

    protected string $rss_url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

//    public function __constructor(ParserRssService $parserRssService){
//        $this->parserRssService = $parserRssService;
//    }

    /**
     * @throws GuzzleException
     */
    public function parser(ParserRssService $parserRssService): void
    {
        ParseRSS::dispatch();
    }
}




