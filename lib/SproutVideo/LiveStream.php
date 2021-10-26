<?php
namespace SproutVideo;
class LiveStream extends Resource
{
	public static function list_live_streams($options=null)
	{
		return self::get('live_streams', $options);
	}

	public static function get_live_stream($live_stream_id, $options=null)
	{
		return self::get('live_streams/'.$live_stream_id, $options);
	}

	public static function create_live_stream($file, $body=null, $options=null)
	{
		if ($file == null) {
			return self::post('live_streams', $body, $options);
		} else {
			return self::upload('live_streams', $file, $body, $options, true);
		}
	}

	public static function update_live_stream($live_stream_id, $body=null, $options=null)
	{
        return self::put('live_streams/'.$live_stream_id, $body, $options);
	}

	public static function upload_poster_frame($live_stream_id, $file)
	{
		return self::upload('live_streams/'.$live_stream_id, $file, null, null, true);
	}

	public static function delete_live_stream($live_stream_id, $options=null)
	{
		return self::delete('live_streams/'.$live_stream_id, $options);
	}

	public static function end_live_stream($live_stream_id, $options=null)
	{
		return self::put('live_streams/'.$live_stream_id.'/end_stream', $options);
	}
}
?>
