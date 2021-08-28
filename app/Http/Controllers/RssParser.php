<?php

namespace App\Http\Controllers;

use http\Client\Request;
use GuzzleHttp\Client;
use JetBrains\PhpStorm\ArrayShape;
use Psr\Http\Message\StreamInterface;
use DateTime;
use SimpleXMLElement;

class RssParser extends Controller
{
    public string $rss_url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';
    public StreamInterface $rss_body;

    public function __constructor(){
    }

    public function parser()
    {
        $client = new Client();
        $response = $client->request('GET', $this->rss_url);

        $response->getStatusCode(); // 200
        $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        $this->rss_body = $response->getBody();

        $rss = simplexml_load_string($this->rss_body);

        $items = [];

        foreach ($rss->channel->item as $entry) {
            $imageData = [];
            foreach ($entry->enclosure as $enclosure){
                $imageData [] = getImagesJson($enclosure);
            }

            $item = [
                'title' => (string)$entry->title,
                'link' => (string)$entry->link,
                'author' => (string)$entry->author,
                'description' => (string)$entry->description,
                'image' => (string) json_encode($imageData),
                'pubDate' => (string)$entry->pubDate,
            ];

            $items[] = $item;
        }
    }
}

#[ArrayShape(["url" => "false|mixed", "type" => "false|mixed", "length" => "false|mixed"])]
function getImagesJson(SimpleXMLElement $data): array {
    return [
        "url" => current($data['url']),
        "type" => current($data['type']),
        "length" => current($data['length']),
    ];
}




