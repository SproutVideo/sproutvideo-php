<?php
namespace SproutVideo;
class Analytics extends Resource
{
	public static function play_counts($options=null)
	{
		return self::build_url_and_get('stats/counts',  $options);
	}

	public static function domains($options=null)
	{
		return self::build_url_and_get('stats/domains', $options);
	}

	public static function geo($options=null)
	{
		return self::build_url_and_get('stats/geo', $options);
	}

	public static function video_types($options=null)
	{
		return self::build_url_and_get('stats/video_types', $options, false);
	}

	public static function playback_types($options=null)
	{
		return self::build_url_and_get('stats/playback_types', $options, false);
	}
	public static function device_types($options=null)
	{
		return self::build_url_and_get('stats/device_types', $options);
	}

	public static function engagement($options=null)
	{
		return self::build_url_and_get('stats/engagement', $options);
	}

	public static function engagement_sessions($video_id=null, $options=null)
	{
		if(!is_null($video_id)) {
			return self::get("stats/engagement/{$video_id}/sessions", $options);
		} else {
			return self::get("stats/engagement/sessions", $options);
		}
	}

	public static function live_streams_engagement($options=null)
	{
        if (!empty($options) && $options['live_stream_id']) {
		    return self::build_url_and_get('stats/engagement', $options);
        } else {
            return self::get("stats/live_streams/engagement", $options);
        }
	}

	public static function live_streams_engagement_sessions($options=null)
	{
        if (!empty($options) && $options['live_stream_id']) {
		    return self::build_url_and_get('stats/engagement/sessions', $options);
        } else {
            return self::get("stats/live_streams/engagement/sessions", $options);
        }
	}


	private static function build_url_and_get($base, &$options, $can_be_live_stream=true) {
		if (!empty($options) && array_key_exists('video_id', $options)) {
			$base .= "/{$options['video_id']}";
			unset($options['video_id']);
		}

		if ($can_be_live_stream && !empty($options) && array_key_exists('live_stream_id', $options)) {
            $path = explode('/', $base);
            $middle_path = ['live_streams', $options['live_stream_id']];
            array_splice( $path, 1, 0, $middle_path );
            $base = implode('/', $path);
		}
		unset($options['live_stream_id']);
		return self::get($base, $options);
	}
}
?>
