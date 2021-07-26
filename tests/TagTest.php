<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class TagTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        SproutVideo\Tag::list_tags();

        self::$resource->shouldHaveReceived('get')->once()->with('tags', null);  
    }

    public function testItCanGetDetails()
    {
        SproutVideo\Tag::get_tag('213asf');

        self::$resource->shouldHaveReceived('get')->once()->with('tags/213asf', null);  
    }

    public function testItCanCreate()
    {
        $data = array(
            'name' => 'New Tag',
        );
        SproutVideo\Tag::create_tag($data);

        self::$resource->shouldHaveReceived('post')->once()->with('tags', $data, null);  
    }

    public function testItCanUpdate()
    {
        $data = [ 'name' => 'beacch vibezz' ];
        SproutVideo\Tag::update_tag('1212', $data);

        self::$resource->shouldHaveReceived('put')->once()->with('tags/1212', $data, null);  
    }

    public function testItCanDelete()
    {
        SproutVideo\Tag::delete_tag('1212');

        self::$resource->shouldHaveReceived('delete')->once()->with('tags/1212', null);  
    }
}