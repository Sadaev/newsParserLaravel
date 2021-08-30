<?php

namespace App\Http\Controllers;

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
    public function parser(ParserRssService $parserRssService): bool
    {
        $response = $parserRssService->parseRssFeedByUrl($this->rss_url);

        return $response;
    }

    public function saveRequestLog() {
        return RequestLogController::create([
            "request_url" => $this->rss_url,
            "request_method" => $this->method,
            "response_http_code" => $response->getStatusCode(), // 200
            "response_body" => $response->getBody(),
        ]);
    }
}




