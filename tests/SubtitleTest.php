<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class SubtitleTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetAll()
    {
        $options = ['video_id' => '1234'];
        SproutVideo\Subtitle::list_subtitles($options);

        self::$resource->shouldHaveReceived('get')->once()->with('videos/1234/subtitles', $options);  
    }

    public function testItCanGetDetails()
    {
        $options = ['video_id' => '1234', 'id' => '123'];
        SproutVideo\Subtitle::get_subtitle($options);

        self::$resource->shouldHaveReceived('get')->once()->with('videos/1234/subtitles/'.$options['id'], $options);  
    }

    public function testItCanCreate()
    {
        $data = ['language' => 'en', 'content' => 'WEBVTT FILE...'];
        $options = ['video_id' => '1234'];
        SproutVideo\Subtitle::create_subtitle($data, $options);

        self::$resource->shouldHaveReceived('post')->once()->with('videos/1234/subtitles', $data, $options);  
    }

    public function testItCanUpdate()
    {
        $data = ['content' => 'WEBVTT FILE.. things.'];
        $options = ['video_id' => '1234', 'id' => '1321'];
        SproutVideo\Subtitle::update_subtitle($data, $options);

        self::$resource->shouldHaveReceived('put')->once()->with('videos/1234/subtitles/'.$options['id'], $data, $options);  
    }

    public function testItCanDelete()
    {
        $options = ['video_id' => '1234', 'id' => '1321'];
        SproutVideo\Subtitle::delete_subtitle($options);

        self::$resource->shouldHaveReceived('delete')->once()->with('videos/1234/subtitles/'.$options['id'], $options);  
    }
}