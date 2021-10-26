<?php
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class LiveStreamTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        SproutVideo\LiveStream::list_live_streams();

        self::$resource->shouldHaveReceived('get')->once()->with('live_streams', null);
    }

    public function testItCanGetDetails()
    {
        SproutVideo\LiveStream::get_live_stream('213asf');

        self::$resource->shouldHaveReceived('get')->once()->with('live_streams/213asf', null);
    }

    public function testItCanCreate()
    {
        $data = [ 'title' => 'beacch vibezz' ];
        SproutVideo\LiveStream::create_live_stream($data);

        self::$resource->shouldHaveReceived('post')->once()->with('live_streams', $data, null);
    }

    public function testItCanCreateAndUpload()
    {
        $file = '/users/dw/beach.jpg';
        $data = [ 'title' => 'beacch vibezz' ];
        SproutVideo\LiveStream::create_live_stream($data, $file);

        self::$resource->shouldHaveReceived('upload')->once()->with('live_streams', $file, $data, null, 'custom_poster_frame');
    }

    public function testItCanUpdate()
    {
        $data = [ 'title' => 'vAcAtIoN' ];
        SproutVideo\LiveStream::update_live_stream('1212', $data);

        self::$resource->shouldHaveReceived('put')->once()->with('live_streams/1212', $data, null);
    }

    public function testItCanUploadPosterFrame()
    {
        $data = [ 'title' => 'vAcAtIoN' ];
        $file = '/users/dw/beach.jpg';
        SproutVideo\LiveStream::update_live_stream('1212', $data, $file);

        self::$resource->shouldHaveReceived('upload')->once()->with('live_streams/1212', $file, $data, ['method' => 'PUT'], 'custom_poster_frame');
    }

    public function testItCanDelete()
    {
        SproutVideo\LiveStream::delete_live_stream('1212');

        self::$resource->shouldHaveReceived('delete')->once()->with('live_streams/1212', null);
    }

    public function testItCanEndStream()
    {
        SproutVideo\LiveStream::end_live_stream('1212');

        self::$resource->shouldHaveReceived('put')->once()->with('live_streams/1212/end_stream', null);
    }
}
