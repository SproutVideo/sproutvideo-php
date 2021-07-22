<?php 
use PHPUnit\Framework\TestCase;

final class CurlClientTest extends TestCase
{
    public function testItSetsTheApiKey()
    {
        SproutVideo::$api_key = 'abc123';
        $client = new SproutVideo\CurlClient();

        $this->assertIsArray($client->headers);
        $this->assertEquals(1, count($client->headers));
        $this->assertEquals('abc123', $client->headers['SproutVideo-Api-Key']);
    }

    public function testItSetsPostHeaders()
    {
        $client = new SproutVideo\CurlClient();
        $body = ['name' => 'test'];

        $client->buildRequest('POST', 'tags', json_encode($body), NULL, false);
        $this->assertEquals(3, count($client->headers));
        $this->assertEquals('application/json;charset=utf-8', $client->headers['Content-Type']);
        $this->assertEquals(15, $client->headers['Content-Length']);
    }

    public function testItSetsPutHeaders()
    {
        $client = new SproutVideo\CurlClient();
        $body = ['title' => 'test'];

        $client->buildRequest('PUT', 'videos/119ddbb31b19e1c998', json_encode($body), NULL, false);
        $this->assertEquals(3, count($client->headers));
        $this->assertEquals('application/json;charset=utf-8', $client->headers['Content-Type']);
        $this->assertEquals(16, $client->headers['Content-Length']);
    }

    public function testItDoesNotSetHeadersOnUpload()
    {
        $client = new SproutVideo\CurlClient();
        $body = ['title' => 'test'];

        $client->buildRequest('POST', 'videos', $body, NULL, true);
        $this->assertEquals(1, count($client->headers));
    }
}