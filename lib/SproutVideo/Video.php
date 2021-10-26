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
		if ($file == null) {
			return self::post('videos', $body, $options);
		} else {
			return self::upload('videos', $file, $body, $options, 'source_video');
		}
	}

	public static function update_video($video_id, $body=null, $options=null)
	{
		return self::put('videos/'.$video_id, $body, $options);
	}

	public static function replace_video($video_id, $file)
	{
		return self::upload('videos/' . $video_id . '/replace', $file, null, null, 'source_video');
	}

	public static function upload_poster_frame($video_id, $file)
	{
		return self::upload('videos/'.$video_id, $file, null, ['method' => 'PUT'], 'custom_poster_frame');
	}

	public static function delete_video($video_id, $options=null)
	{
		return self::delete('videos/'.$video_id, $options);
	}

	public static function signed_embed_code($video_id, $security_token, $query_params=array(), $expires=null, $protocol='http')
	{
		$host = 'videos.sproutvideo.com';
		$path = "/embed/{$video_id}/{$security_token}";
		$string_to_sign = "GET\n";
		$string_to_sign .= "{$host}\n";
		$string_to_sign .= "{$path}\n";

		if (is_null($expires)) {
			$expires = time() + 300;
		}

		$query_params = array_merge($query_params, array('expires'=> $expires));
		ksort($query_params);

		$url_params = "";
		foreach ($query_params as $key => $value) {
			$value = trim($value);
			$encoded_value = rawurlencode($value);
			$url_params .= "&{$key}={$encoded_value}";
			$string_to_sign .= "&{$key}={$value}";
		}

		$signature = rawurlencode(base64_encode(hash_hmac('sha1', $string_to_sign, \SproutVideo::$api_key, true)));

		return "{$protocol}://{$host}{$path}?signature={$signature}{$url_params}";
	}
}
?>
