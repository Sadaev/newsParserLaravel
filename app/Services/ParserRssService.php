<?php
namespace App\Services;

use App\Dto\NewsCreateDto;
use App\Dto\RequestLogCreateDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

use DateTime;

class ParserRssService
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
    public function parseRssFeedByUrl(string $url): int
    {
        $this->rss_url = $url;
        $this->rss_body = $this->getRssData();

        $rss = simplexml_load_string($this->rss_body);

        $news = $this->parseRss($rss);

        $this->saveNews($news);

        return count($news);
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

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    function saveRequest(ResponseInterface $response){
        $data = [
            "request_method" => $this->method ?? '',
            "request_url" => $this->rss_url ?? '',
            "response_body" => $response->getBody() ?? '',
            "response_http_code" => $response->getStatusCode() ?? '',
        ];

        $requestDto = new RequestLogCreateDto($data);
        $requestLogService = new RequestLogService();

        return $requestLogService->create($requestDto);
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Exception
     */
    function saveNews(array $news){

        $newsService = new NewsService();


        foreach($news as $item){
            $data = [
                'title' => $item['title'],
                'link' => $item['link'],
                'author' => $item['author'],
                'image' => $item['image'],
                'pubDate' => new DateTime($item['pubDate']),
                'description' => $item['description'],
            ];

            $newsCreateDto = new NewsCreateDto($data);

            $newsService->create($newsCreateDto);
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
