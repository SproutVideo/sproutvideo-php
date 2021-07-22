<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class CallToActionTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        $options = ['video_id' => '1234'];
        SproutVideo\CallToAction::list_ctas($options);

        self::$resource->shouldHaveReceived('get')->once()->with('videos/1234/calls_to_action', $options);  
    }

    public function testItCanGetDetails()
    {
        $options = ['video_id' => '1234', 'id' => '123'];
        SproutVideo\CallToAction::get_cta($options);

        self::$resource->shouldHaveReceived('get')->once()->with('videos/1234/calls_to_action/'.$options['id'], $options);  
    }

    public function testItCanCreate()
    {
        $data = ['text' => 'en', 'url' => 'https://test.com', 'start_time' => 1, 'end_time' => 2];
        $options = ['video_id' => '1234'];
        SproutVideo\CallToAction::create_cta($data, $options);

        self::$resource->shouldHaveReceived('post')->once()->with('videos/1234/calls_to_action', $data, $options);  
    }

    public function testItCanUpdate()
    {
        $data = ['text' => 'WEBVTT FILE.. things.'];
        $options = ['video_id' => '1234', 'id' => '1321'];
        SproutVideo\CallToAction::update_cta($data, $options);

        self::$resource->shouldHaveReceived('put')->once()->with('videos/1234/calls_to_action/'.$options['id'], $data, $options);  
    }

    public function testItCanDelete()
    {
        $options = ['video_id' => '1234', 'id' => '1321'];
        SproutVideo\CallToAction::delete_cta($options);

        self::$resource->shouldHaveReceived('delete')->once()->with('videos/1234/calls_to_action/'.$options['id'], $options);  
    }
}