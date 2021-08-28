<?php

use GuzzleHttp\Client;
use App\Models\NewsModel;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RequestLogController;

class ParserRssService extends Service
{
    public string $rss_url;
    public StreamInterface $rss_body;
    public Client $client;
    public string $method;

    public function __construct(){
        $this->client = new Client();
        $this->method = 'GET';
    }

    /**
     * @throws GuzzleException
     */
    public function getRssData(): StreamInterface
    {
        $response = $this->client->request($this->method, $this->rss_url);
        $this->saveRequest($response);

        return $response->getBody();
    }

    /**
     * @throws GuzzleException
     */
    public function parseRssFeedByUrl(string $url): void
    {
        $this->rss_url = $url;
        $this->rss_body = $this->getRssData();

        $rss = simplexml_load_string($this->rss_body);

        $news = $this->parseRss($rss);

        $this->saveNews($news);

    }

    public function parseRss($rss): array
    {
        $items = [];

        foreach ($rss->channel->item as $entry) {
            $imageData = [];
            foreach ($entry->enclosure as $enclosure) {
                $imageData [] = $this->getImagesJson($enclosure);
            }
            $item = [
                'title' => (string)$entry->title,
                'link' => (string)$entry->link,
                'author' => (string)$entry->author,
                'description' => (string)$entry->description,
                'image' => (string)json_encode($imageData),
                'pubDate' => (string)$entry->pubDate,
            ];
            $items[] = $item;
        }

        return $items;
    }

    public function rss() {

    }

    function saveRequest(ResponseInterface $response){
        return RequestLogController::create([
            "request_url" => $this->rss_url,
            "request_method" => $this->method,
            "response_http_code" => $response->getStatusCode(), // 200
            "response_body" => $response->getBody(),
        ]);
    }

    function saveNews(array $news){
        foreach($news as $item){
            NewsController::create($item);
        }
    }

    function getImagesJson(SimpleXMLElement $data): array {
        return [
            "url" => current($data['url']),
            "type" => current($data['type']),
            "length" => current($data['length']),
        ];
    }

}
