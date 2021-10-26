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

<!-- require_once './lib/SproutVideo/Autoloader.php';
sproutVideo_Autoloader::register();
SproutVideo::$api_key = 'e82a10bc3d77caea6c49ff7f635f28be';
SproutVideo::$base_url = "https://api.sproutvideo-staging.com/v1" -->
