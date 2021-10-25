<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class AnalyticsTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItCanGetPlayCounts()
    {
        SproutVideo\Analytics::play_counts();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/counts', null);  
    }

    public function testItCanGetPlayCountsForSingleVideo()
    {
        SproutVideo\Analytics::play_counts(['video_id' => '123abc']);

        self::$resource->shouldHaveReceived('get')->once()->with('stats/counts/123abc', null);  
    }

    public function testItCanGetDomains()
    {
        SproutVideo\Analytics::domains();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/domains', null);  
    }

    public function testItCanGetGeo()
    {
        SproutVideo\Analytics::geo();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/geo', null);  
    }

    public function testItCanGetVideoTypes()
    {
        SproutVideo\Analytics::video_types();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/video_types', null);  
    }

    public function testItCanGetPlaybackTypes()
    {
        SproutVideo\Analytics::playback_types();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/playback_types', null);  
    }

    public function testItCanGetDeviceTypes()
    {
        SproutVideo\Analytics::device_types();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/device_types', null);  
    }

    public function testItCanGetEngagement()
    {
        SproutVideo\Analytics::engagement();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/engagement', null);  
    }

    public function testItCanGetEngagementSessions()
    {
        SproutVideo\Analytics::engagement_sessions();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/engagement/sessions', null);  
    }

    public function testItCanGetEngagementSessionsWithId()
    {
        SproutVideo\Analytics::engagement_sessions('abc123');

        self::$resource->shouldHaveReceived('get')->once()->with('stats/engagement/abc123/sessions', null);  
    }
}