<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class PlaylistTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        SproutVideo\Playlist::list_playlists();

        self::$resource->shouldHaveReceived('get')->once()->with('playlists', null);  
    }

    public function testItCanGetDetails()
    {
        SproutVideo\Playlist::get_playlist('213asf');

        self::$resource->shouldHaveReceived('get')->once()->with('playlists/213asf', null);  
    }

    public function testItCanCreate()
    {
        $data = array(
            'title' => 'New Playlist',
            'privacy' => 2,
            'videos' => array('abc123','def456','ghi789')
        );
        SproutVideo\Playlist::create_playlist($data);

        self::$resource->shouldHaveReceived('post')->once()->with('playlists', $data, null);  
    }

    public function testItCanUpdate()
    {
        $data = [ 'title' => 'newwww PlAyLiSt' ];
        SproutVideo\Playlist::update_playlist('1212', $data);

        self::$resource->shouldHaveReceived('put')->once()->with('playlists/1212', $data, null);  
    }

    public function testItCanDelete()
    {
        SproutVideo\Playlist::delete_playlist('1212');

        self::$resource->shouldHaveReceived('delete')->once()->with('playlists/1212', null);  
    }
}