<?php


use Manticoresearch\Client;
use Manticoresearch\Exceptions\ConnectionException;

class SearchTest  extends \PHPUnit\Framework\TestCase
{
    public function testEmptyBody()
    {
        $params = ['host' => $_SERVER['MS_HOST'], 'port' => $_SERVER['MS_PORT']];
        $client = new Client($params);
        $this->expectException(\Manticoresearch\Exceptions\ResponseException::class);
        $client->search(['body'=>'']);
    }

    public function testNoArrayParams()
    {
        $params = ['host' => $_SERVER['MS_HOST'], 'port' => $_SERVER['MS_PORT']];
        $client = new Client($params);
        $this->expectException(TypeError::class);
        $client->search('this is not a json');
    }
    public function testMissingIndex()
    {
        $params = ['host' => $_SERVER['MS_HOST'], 'port' => $_SERVER['MS_PORT']];
        $client = new Client($params);
        $this->expectException(\Manticoresearch\Exceptions\ResponseException::class);
        $response =$client->search( [
            'body' => [

                'query' => [
                    'match_phrase' => [
                        'title' => 'find me',
                    ]
                ]
            ]
        ]);

    }

    public function testPath()
    {
        $search = new \Manticoresearch\Endpoints\Search();
        $this->assertEquals('/json/search', $search->getPath());
    }

}