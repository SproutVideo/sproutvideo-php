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

     public function testItCanGetDownloadCounts()
    {
        SproutVideo\Analytics::download_counts();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/downloads', null);
    }

    public function testItCanGetPlayCountsForSingleVideo()
    {
        SproutVideo\Analytics::play_counts(['video_id' => '123abc']);

        self::$resource->shouldHaveReceived('get')->once()->with('stats/counts/123abc', null);
    }

    public function testItCanGetPlayCountsForSingleLiveStream()
    {
        SproutVideo\Analytics::play_counts(['live_stream_id' => '123abc']);

        self::$resource->shouldHaveReceived('get')->once()->with('stats/live_streams/123abc/counts', null);
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

    public function testItWillNotGetVideoTypesForLiveStream()
    {
        SproutVideo\Analytics::video_types(['live_stream_id' => '123abc']);

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

    public function testItCanGetPopularVideos()
    {
        SproutVideo\Analytics::popular_videos();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/popular_videos', null);
    }

    public function testItCanGetPopularDownloads()
    {
        SproutVideo\Analytics::popular_downloads();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/popular_downloads', null);
    }

    public function testItCanGetLiveStreamOverview()
    {
        SproutVideo\Analytics::live_stream_overview(['live_stream_id' => '123abc']);

        self::$resource->shouldHaveReceived('get')->once()->with('stats/live_streams/123abc/overview', null);
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

    public function testItCanGetLiveStreamEngagement()
    {
        SproutVideo\Analytics::live_streams_engagement();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/live_streams/engagement', null);
    }

    public function testItCanGetLiveStreamEngagementWithId()
    {
        SproutVideo\Analytics::live_streams_engagement(['live_stream_id' => '123']);

        self::$resource->shouldHaveReceived('get')->once()->with('stats/live_streams/123/engagement', null);
    }

    public function testItCanGetLiveStreamEngagementSessions()
    {
        SproutVideo\Analytics::live_streams_engagement_sessions();

        self::$resource->shouldHaveReceived('get')->once()->with('stats/live_streams/engagement/sessions', null);
    }

    public function testItCanGetLiveStreamEngagementSesssionsWithId()
    {
        SproutVideo\Analytics::live_streams_engagement_sessions(['live_stream_id' => '123']);

        self::$resource->shouldHaveReceived('get')->once()->with('stats/live_streams/123/engagement/sessions', null);
    }
}
