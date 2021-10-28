<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class UploadTokenTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItCanCreate()
    {
        $data = array(
            'return_url' => 'https://sproutvideo.com',
        );
        SproutVideo\UploadToken::create_upload_token($data);

        self::$resource->shouldHaveReceived('post')->once()->with('upload_tokens', $data, null);  
    }
}