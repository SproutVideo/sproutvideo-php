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

	public static function create_live_stream($body=null, $file=null, $options=null)
	{
		if ($file == null) {
			return self::post('live_streams', $body, $options);
		} else {
			return self::upload('live_streams', $file, $body, $options, 'custom_poster_frame');
		}
	}

	public static function update_live_stream($live_stream_id, $body=null, $file=null, $options=null)
	{
		if ($file == null) {
            return self::put('live_streams/'.$live_stream_id, $body, $options);
		} else {
		    return self::upload('live_streams/'.$live_stream_id, $file, $body, ['method' => 'PUT'], 'custom_poster_frame');
		}
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
