<?php
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class VideoTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        SproutVideo\Video::list_videos();

        self::$resource->shouldHaveReceived('get')->once()->with('videos', null);
    }

    public function testItCanGetDetails()
    {
        SproutVideo\Video::get_video('213asf');

        self::$resource->shouldHaveReceived('get')->once()->with('videos/213asf', null);
    }

    public function testItCanCreate()
    {
        $data = [ 'title' => 'beacch vibezz' ];
        SproutVideo\Video::create_video(null, $data);

        self::$resource->shouldHaveReceived('post')->once()->with('videos', $data, null);
    }

    public function testItCanCreateAndUpload()
    {
        $file = '/users/dw/beach.mov';
        $data = [ 'title' => 'beacch vibezz' ];
        SproutVideo\Video::create_video($file, $data);

        self::$resource->shouldHaveReceived('upload')->once()->with('videos', $file, $data, null, 'source_video');
    }

    public function testItCanUpdate()
    {
        $data = [ 'title' => 'vAcAtIoN' ];
        SproutVideo\Video::update_video('1212', $data);

        self::$resource->shouldHaveReceived('put')->once()->with('videos/1212', $data, null);
    }

    public function testItCanReplace()
    {
        $file = '/users/dw/beach.mov';
        SproutVideo\Video::replace_video('1212', $file);

        self::$resource->shouldHaveReceived('upload')->once()->with('videos/1212/replace', $file, null, null, 'source_video');
    }

    public function testItCanUploadPosterFrame()
    {
        $file = '/users/dw/beach.jpg';
        SproutVideo\Video::upload_poster_frame('1212', $file);

        self::$resource->shouldHaveReceived('upload')->once()->with('videos/1212', $file, null, ['method' => 'PUT'], 'custom_poster_frame');
    }

    public function testItCanDelete()
    {
        SproutVideo\Video::delete_video('1212');

        self::$resource->shouldHaveReceived('delete')->once()->with('videos/1212', null);
    }

    public function testItCanSignAnEmbedCode()
    {
        $url = SproutVideo\Video::signed_embed_code('1212', 'sec1212');
        $actual = explode('?', $url)[0];
        $expected = 'http://videos.sproutvideo.com/embed/1212/sec1212';

        $this->assertEquals($expected, $actual);
        $this->assertEquals(49, strpos($url, 'signature'));
    }
}
