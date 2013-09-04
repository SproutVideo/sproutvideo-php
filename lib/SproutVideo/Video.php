<?php
namespace SproutVideo;
class Video extends Resource
{
	public static function list_videos($options=null)
	{
		return self::get('videos', $options);
	}

	public static function get_video($video_id, $options=null)
	{
		return self::get('videos/'.$video_id, $options);
	}

	public static function create_video($file, $body=null, $options=null)
	{
		return self::upload('videos', $file, $body, $options);
	}

	public static function update_video($video_id, $body=null, $options=null)
	{
		return self::put('videos/'.$video_id, $body, $options);
	}

	public static function delete_video($video_id, $options=null)
	{
		return self::delete('videos/'.$video_id, $options);
	}
}
?>