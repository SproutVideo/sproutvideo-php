<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class FolderTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        SproutVideo\Folder::list_folders();

        self::$resource->shouldHaveReceived('get')->once()->with('folders', null);  
    }

    public function testItCanGetDetails()
    {
        SproutVideo\Folder::get_folder('213asf');

        self::$resource->shouldHaveReceived('get')->once()->with('folders/213asf', null);  
    }

    public function testItCanCreate()
    {
        $data = [ 'name' => 'new folder' ];
        SproutVideo\Folder::create_folder($data);

        self::$resource->shouldHaveReceived('post')->once()->with('folders', $data, null);  
    }

    public function testItCanUpdate()
    {
        $data = [ 'name' => 'new folder' ];
        SproutVideo\Folder::update_folder('1212', $data);

        self::$resource->shouldHaveReceived('put')->once()->with('folders/1212', $data, null);  
    }

    public function testItCanDelete()
    {
        SproutVideo\Folder::delete_folder('1212');

        self::$resource->shouldHaveReceived('delete')->once()->with('folders/1212', null);  
    }
}